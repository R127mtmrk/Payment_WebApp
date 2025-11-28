<?php
require_once 'Core/DbConnect.php';

function ConnectSelect(string $username, string $password): array|bool {
    global $pdo;

    if (!$pdo) {
        die('ERREUR: la connexion PDO n\'est pas initialisée.');
    }

    $sql = "SELECT id_user, psd_user, email_user, mdp_user, role_user, is_active
            FROM Users 
            WHERE psd_user = :psd OR email_user = :mail";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':psd', $username);
    $stmt->bindParam(':mail', $username);

    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return false;
    }

    if ((int)$user['is_active'] === 0) {
        return false;
    }

    if (!password_verify($password, $user['mdp_user'])) {
        return false;
    }

    return $user;
}

function SelectUser(string $username): array|bool {
    global $pdo;

    $sql = "SELECT * FROM Users WHERE psd_user = :psd OR email_user = :mail";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':psd', $username);
    $stmt->bindValue(':mail', $username);

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function CheckUserExists(string $username, string $email): bool {
    global $pdo;
    $sql = "SELECT id_user FROM Users WHERE psd_user = :username OR email_user = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch() !== false;
}

function SelectAllTransactions(): array {
    global $pdo;

    $sql = "SELECT t.*, 
                   s.psd_user AS sender_name,
                   r.psd_user AS receiver_name,
                   d.num_card, d.expiration_date
            FROM Transac t
            LEFT JOIN Users s ON t.id_sender = s.id_user
            LEFT JOIN Users r ON t.id_receiver = r.id_user
            LEFT JOIN Debit_Cards d ON t.id_card_used = d.id_card
            ORDER BY t.date_transac DESC";

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function SelectUserTransactions(int $id_user): array {
    global $pdo;
    if ($id_user) {
        $sql = "SELECT t.*, 
                       d.num_card, d.expiration_date, d.pan_encrypted, d.pan_iv,
                       u.psd_user AS receiver_name
                FROM Transac t
                LEFT JOIN Debit_Cards d ON t.id_card_used = d.id_card
                LEFT JOIN Users u ON t.id_receiver = u.id_user
                WHERE t.id_sender = :id_user
                ORDER BY t.date_transac DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}

function SelectUserCards(int $id_user): array {
    global $pdo;
    $sql = "SELECT id_card, num_card, expiration_date FROM Debit_Cards WHERE id_user_card = :id_user";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function CheckCardOwner(int $id_card, int $id_user): array|bool {
    global $pdo;
    $sql = "SELECT id_card FROM Debit_Cards WHERE id_card = :id_card AND id_user_card = :id_user";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_card', $id_card, PDO::PARAM_INT);
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

function SelectTransactionById(int $idTransac): array|bool {
    global $pdo;
    $sql = "SELECT * FROM Transac WHERE id_transac = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idTransac, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
