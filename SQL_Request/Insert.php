<?php
require_once 'Select.php';

function InsertAccount(string $username, string $email, string $password): bool {
    global $pdo;

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Users (psd_user, email_user, mdp_user) VALUES (:pseudo, :email, :mdp)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':pseudo', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mdp', $hashedPassword);

    try {
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return false;
    }
}

function InsertTransaction($idSender, $usernameReceiver, $sumTransaction, $idCard, $message): string|bool {
    global $pdo;

    $Receiver = SelectUser($usernameReceiver);
    if (!$Receiver) {
        return "Le destinataire n'existe pas.";
    }

    if (isset($Receiver['is_active']) && (int)$Receiver['is_active'] === 0) {
        return "Ce destinataire a clôturé son compte. Transaction impossible.";
    }

    if (!CheckCardOwner($idCard, $idSender)) {
        return "Erreur : Cette carte ne vous appartient pas.";
    }

    $sql = "INSERT INTO Transac (id_sender, id_receiver, sum_transac, id_card_used, msg_transac) 
            VALUES (:idSender, :idReceiver, :sum_transac, :idCard, :msg)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idSender', $idSender, PDO::PARAM_INT);
    $stmt->bindParam(':idReceiver', $Receiver['id_user'], PDO::PARAM_INT);
    $stmt->bindParam(':sum_transac', $sumTransaction, PDO::PARAM_INT);
    $stmt->bindParam(':idCard', $idCard, PDO::PARAM_INT);
    $stmt->bindParam(':msg', $message);

    try {
        if($stmt->execute()) {
            return true;
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return "Erreur technique lors de la transaction.";
    }
    return "Erreur inconnue.";
}

function InsertCard($user, $numCard, $expirationDate): bool {
    global $pdo;

    $result = SelectUser($user);

    if ($result) {
        require_once __DIR__ . '/Core/Secrets.php';

        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);

        try {
            $iv = random_bytes($ivlen);
        } catch (Exception $e) {
            error_log("Erreur critique : Impossible de générer un IV sécurisé.");
            error_log($e->getMessage());
            return false;
        }

        $encryptedCard = openssl_encrypt($numCard, $cipher, ENCRYPTION_KEY, 0, $iv);

        if ($encryptedCard === false) {
            error_log("Erreur de chiffrement des données.");
            return false;
        }

        $ivHex = bin2hex($iv);
        $lastFourDigits = substr($numCard, -4);

        $firstFourDigits = substr($numCard, 0, 4);

        $sql = "INSERT INTO Debit_Cards (id_user_card, num_card, first_digits, expiration_date, pan_encrypted, pan_iv) 
                VALUES (:id_user, :last_four, :first_four, :expiration_date, :pan_encrypted, :pan_iv)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id_user', $result['id_user'], PDO::PARAM_INT);
        $stmt->bindParam(':last_four', $lastFourDigits);
        $stmt->bindParam(':first_four', $firstFourDigits);
        $stmt->bindParam(':expiration_date', $expirationDate);
        $stmt->bindParam(':pan_encrypted', $encryptedCard);
        $stmt->bindParam(':pan_iv', $ivHex);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    return false;
}

function MakeRefund($idOriginalTransac): string|bool {
    global $pdo;

    $original = SelectTransactionById($idOriginalTransac);

    if (!$original) {
        return "Transaction introuvable.";
    }

    if ((int)$original['refund_transac'] === 1) {
        return "Cette transaction a déjà été remboursée.";
    }

    if ($original['sum_transac'] > 10000) {
        return "Erreur : Le remboursement est limité à 10 000 € maximum par transaction.";
    }

    $newSender = $original['id_receiver'];
    $newReceiver = $original['id_sender'];
    $amount = $original['sum_transac'];

    $message = "REMBOURSEMENT de la transaction #" . $original['id_transac'];

    try {
        $pdo->beginTransaction();

        $sqlUpdate = "UPDATE Transac SET refund_transac = 1 WHERE id_transac = :id";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':id', $idOriginalTransac, PDO::PARAM_INT);
        $stmtUpdate->execute();

        $sqlInsert = "INSERT INTO Transac (id_sender, id_receiver, sum_transac, msg_transac, refund_transac, date_transac, id_card_used) 
                      VALUES (:sender, :receiver, :sum, :msg, 1, NOW(), NULL)";

        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->bindParam(':sender', $newSender, PDO::PARAM_INT);
        $stmtInsert->bindParam(':receiver', $newReceiver, PDO::PARAM_INT);
        $stmtInsert->bindParam(':sum', $amount, PDO::PARAM_INT);
        $stmtInsert->bindParam(':msg', $message);

        $stmtInsert->execute();

        $pdo->commit();
        return true;

    } catch (PDOException $e) {
        $pdo->rollBack();
        error_log($e->getMessage());
        return "Erreur technique lors du remboursement.";
    }
}