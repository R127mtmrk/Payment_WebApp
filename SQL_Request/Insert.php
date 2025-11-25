<?php
require_once 'Select.php';

function InsertAccount(string $username, string $email, string $password): bool {
    global $pdo;

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Users (psd_user, email_user, mdp_user) VALUES (:pseudo, :email, :mdp)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':pseudo', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':mdp', $hashedPassword, PDO::PARAM_STR);

    try {
        return $stmt->execute();
    } catch (PDOException $e) {
    error_log($e->getMessage());
        return false;
    }
}

function InsertTransaction($usernameSender, $usernameReceiver, $sumTransaction) {
    global $pdo;
    $resultSender = SelectUser($usernameSender);
    if ($resultSender) {
        $resultReceiver = SelectUser($usernameReceiver);
        if ($resultReceiver) {
            $Sender = SelectUser($usernameSender);
            $Receiver = SelectUser($usernameReceiver);
            $sql = "INSERT INTO Transac (id_sender, id_receiver, sum_transac) VALUES (:idSender, :idReceiver, :sum_transac)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idSender', $Sender['id_user'], PDO::PARAM_STR);
            $stmt->bindParam(':idReceiver', $Receiver['id_user'], PDO::PARAM_STR);
            $stmt->bindParam(':sum_transac', $sumTransaction, PDO::PARAM_STR);
            try {
                if (!$stmt->execute()){
                    throw new PDOException("Erreur lors de la transaction");
                }
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    } else {

    }
}

function InsertCard($user, $numCard, $expirationDate) {
    global $pdo;
    $result = SelectUser($user);
    $sql = "INSERT INTO Debit_Cards (num_card, id_user_card, expiration_date) VALUES :num_card, :id_user, :expiration_date";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':num_card', $numCard, PDO::PARAM_STR);
    $stmt->bindParam(':id_user', $result['id_user'], PDO::PARAM_STR);
    $stmt->bindParam(':expiration_date', $expirationDate, PDO::PARAM_STR);
    try {
        if (!$stmt->execute()){
            throw new PDOException("Erreur lors de la transaction");
        }
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}