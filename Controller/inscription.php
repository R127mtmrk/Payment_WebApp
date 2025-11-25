<?php
require_once 'cookie_param.php';
require_once 'function.php';
session_start();

if (!isset($_SESSION['connected']) || function_exists($_SESSION['connected'] !== true)) {

    require '../views/inscription.php';
    require '../SQL_Request/Insert.php';

    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
    $mail = isset($_POST['usermail']) ? htmlspecialchars($_POST['mail']) : '';
    $password_create = isset($_POST['password_create']) ? htmlspecialchars($_POST['password']) : '';
    $password_confirm = isset($_POST['password_confirm']) ? htmlspecialchars($_POST['password_confirm']) : '';


    if (passwordStrong($password_create)){

        if (empty($username) || empty($mail) || empty($password_create)) {
            $errorMessage = "Veuillez remplir tous les champs.";
        }
        elseif ($password_create !== $password_confirm) {
            $errorMessage = "Les mots de passe ne correspondent pas.";
        }
        elseif (CheckUserExists($username, $mail)) {
            $errorMessage = "Ce nom d'utilisateur ou cet email est déjà pris.";
        }
        else {
            if (InsertAccount($username, $mail, $password_create)) {
                $successMessage = "Inscription réussie ! Vous pouvez vous connecter.";
            } else {
                $errorMessage = "Une erreur technique est survenue lors de l'inscription.";
            }
        }
    }else{
        echo "Le mot de passe est pas assez sécurisé";
    }

} else {
    // Envoi du header 404 Not Found
    require '../Views/404.php';
}