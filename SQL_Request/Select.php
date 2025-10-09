<?php
require_once 'Core/DbConnect.php';
function ConnectSelect($username, $password) {
    $sql = "SELECT psd_username, email_user, mdp_user FROM Users WHERE psd_user = :username OR email_user = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $hashPassword = hash('sha384',$password);
        if ($hashPassword = $result['mdp_user']) {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function SelectUser($username) {
    $sql = "SELECT * FROM Users WHERE psd_user = :username OR email_user = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function SelectAllTransaction($maxReturn) {
    if ($maxReturn > 0) {
        $sql = "SELECT * FROM Transac LIMIT :maxReturn";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':maxReturn', $maxReturn, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } else {
        return null;
    }
}

function SelectUserTransactions($username) {
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
    $sql = "SELECT * FROM Transac WHERE DATE(date) = CURDATE()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function SelectMonthlyTransaction() {
    $sql = "SELECT * FROM Transac WHERE MONTH(date) = MONTH(CURDATE())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function SelectYearlyTransaction() {
    $sql = "SELECT * FROM Transac WHERE YEAR(date) = YEAR(CURDATE())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
