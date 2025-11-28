<?php
require_once 'init.php';

$errorMessage = "";
$successMessage = "";

redirectIfConnected();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Erreur CSRF : Requête non autorisée.");
    }

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['usermail'] ?? '');
    $password_create = $_POST['password_create'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    $errors = [];


    if (empty($username) || empty($email) || empty($password_create) || empty($password_confirm)) {
        $errors[] = "Tous les champs sont obligatoires.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Le format de l'adresse email est invalide.";
    }

    if ($password_create !== $password_confirm) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};\':"|,.<>\/?]).{8,}$/', $password_create)) {
        $errors[] = "Le mot de passe doit contenir 8 caractères, majuscule, minuscule, chiffre et caractère spécial.";
    }

    if (empty($errors) && CheckUserExists($username, $email)) {
        $errors[] = "Ce nom d'utilisateur ou cet email est déjà utilisé.";
    }

    if (!empty($errors)) {
        $errorMessage = $errors[0];

    } elseif (InsertAccount($username, $email, $password_create)) {
        $successMessage = "Inscription réussie ! Vous pouvez vous connecter.";
        $_POST = [];

    } else {
        $errorMessage = "Une erreur technique est survenue lors de l'inscription.";
    }
}

require '../Views/inscription.php';