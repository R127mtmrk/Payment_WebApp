<?php
require_once 'cookie_param.php';
require_once 'function.php';
session_start();

if (!isset($_SESSION['connected']) || function_exists($_SESSION['connected'] !== true)) {

    require '../views/inscription.php';
    require '../SQL_Request/Insert.php';

    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
    $mail = isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : '';
    $password_create = isset($_POST['password_create']) ? htmlspecialchars($_POST['password']) : '';
    $password_confirm = isset($_POST['password_confirm']) ? htmlspecialchars($_POST['password_confirm']) : '';


    if (passwordStrong($password_create)){

        if ($password_create === $password_confirm) {
            InsertAccount($username, $mail, $password_create);
        } else {
            echo "Les mots de passe ne correspondent pas";
        }

    }else{
        echo "Le mot de passe est pas assez sécurisé";
    }

    } else {
    // Envoi du header 404 Not Found
    require '../Views/404.php';
}