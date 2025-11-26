<?php
require_once 'cookie_param.php';
require_once 'function.php';
require '../SQL_Request/Insert.php';

session_start();

$errorMessage = "";
$successMessage = "";

if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
        $mail = isset($_POST['usermail']) ? htmlspecialchars($_POST['usermail']) : '';
        $password_create = isset($_POST['password_create']) ? $_POST['password_create'] : '';
        $password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';

        if (empty($username) || empty($mail) || empty($password_create)) {
            $errorMessage = "Veuillez remplir tous les champs.";
        }
        elseif ($password_create !== $password_confirm) {
            $errorMessage = "Les mots de passe ne correspondent pas.";
        }
        elseif (!passwordStrong($password_create)) {
            $errorMessage = "Le mot de passe doit contenir 8 caractères, majuscule, minuscule, chiffre et caractère spécial.";
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
    }

    require '../views/inscription.php';

} else {
    require '../Views/404.php';
}