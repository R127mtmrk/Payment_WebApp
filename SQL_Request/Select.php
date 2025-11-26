<?php
require_once 'Core/DbConnect.php';

function ConnectSelect($username, $password) {
    global $pdo;

    if (!$pdo) {
        die('ERREUR: la connexion PDO n\'est pas initialisée.');
    }

    $sql = "SELECT id_user, psd_user, email_user, mdp_user 
            FROM Users 
            WHERE psd_user = :psd OR email_user = :mail";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':psd', $username, PDO::PARAM_STR);
    $stmt->bindParam(':mail', $username, PDO::PARAM_STR);

    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return false;
    }

    if (!password_verify($password, $user['mdp_user'])) {
        return false;
    }

    return $user;
}

function SelectUser($username) {
    global $pdo;
    $sql = "SELECT * FROM Users WHERE psd_user = :username OR email_user = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function CheckUserExists($username, $email) {
    global $pdo;
    $sql = "SELECT id_user FROM Users WHERE psd_user = :username OR email_user = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch() !== false;
}

function SelectAllTransaction($maxReturn) {
    global $pdo;
    if ($maxReturn > 0) {
        $sql = "SELECT * FROM Transac LIMIT :max";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':max', (int)$maxReturn, PDO::PARAM_INT); // Correction ici pour le LIMIT
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return null;
}

function SelectUserTransactions($username) {
    global $pdo;
    if ($username) {
        $sql = "SELECT * FROM Transac WHERE psd_user = :username";
        //TODO: Correction il faudra faire une jointure pour récupérer les transactions d'un utilisateur via son ID, pas son pseudo.
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return null;
}

function SelectDailyTransaction() {
    global $pdo;
    $sql = "SELECT * FROM Transac WHERE DATE(date) = CURDATE()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function SelectMonthlyTransaction() {
    global $pdo;
    $sql = "SELECT * FROM Transac WHERE MONTH(date) = MONTH(CURDATE())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function SelectYearlyTransaction() {
    global $pdo;
    $sql = "SELECT * FROM Transac WHERE YEAR(date) = YEAR(CURDATE())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
