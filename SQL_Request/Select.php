<?php
require_once 'Core/DbConnect.php';
function ConnectSelect($username, $password) {
    $sql = "SELECT psd_username, email_user, mdp_user FROM Users WHERE psd_user = :username OR email_user = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        if (password_verify($password, $result['psd_password'])) {
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