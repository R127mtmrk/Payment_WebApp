<?php
ini_set('session.cookie_httponly', 1);
session_start();

if (!isset($_SESSION['connected']) || !function_exists($_SESSION['connected'])) {

    require '../views/inscription.php';
    require '../SQL_Request/Insert.php';

    $username = htmlspecialchars($_POST['username']);
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars($_POST['password']);
    $password_confirm = htmlspecialchars($_POST['password_confirm']);

    if ($password === $password_confirm) {
        InsertAccount($username, $mail, $password);
    } else {
        echo "Les mots de passe ne correspondent pas";
    }

    } else {
    // Envoi du header 404 Not Found
    require '../Views/404.php';
}