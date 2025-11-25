<?php
require_once 'Core/DbConnect.php';
function ConnectSelect($username, $password) {
    global $pdo;
    if (!$pdo) {
        die('❌ ERREUR: la connexion PDO n\'est pas initialisée.');
    }
    $sql = "SELECT psd_user, email_user, mdp_user 
        FROM Users 
        WHERE psd_user = :username OR email_user = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $username, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $hashPassword = hash('sha384',$password);
        if ($hashPassword == $result['mdp_user']) {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function SelectUser($username) {
    global $pdo;
    $sql = "SELECT * FROM Users WHERE psd_user = :username OR email_user = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function SelectAllTransaction($maxReturn) {
    global $pdo;
    if ($maxReturn > 0) {
        $maxReturn = (int)$maxReturn; // Sécurise la valeur
        $sql = "SELECT * FROM Transac LIMIT $maxReturn";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } else {
        return null;
    }
}

function SelectUserTransactions($username) {
    global $pdo;
    if ($username) {
        $sql = "SELECT * FROM Transac WHERE psd_user = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } else {
        return null;
    }
}
function SelectDailyTransaction() {
    global $pdo;
    $sql = "SELECT * FROM Transac WHERE DATE(date) = CURDATE()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function SelectMonthlyTransaction() {
    global $pdo;
    $sql = "SELECT * FROM Transac WHERE MONTH(date) = MONTH(CURDATE())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function SelectYearlyTransaction() {
    global $pdo;
    $sql = "SELECT * FROM Transac WHERE YEAR(date) = YEAR(CURDATE())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// Nouvelle fonction pour vérifier si un User ou Email existe déjà (sans vérifier le mot de passe)
function CheckUserExists($username, $email) {
    global $pdo;
    $sql = "SELECT id_user FROM Users WHERE psd_user = :username OR email_user = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Renvoie true si une ligne est trouvée, sinon false
    return $stmt->fetch() !== false;
}