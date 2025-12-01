<?php
require_once 'init.php';
require_once '../SQL_Request/Delete.php';

$errorMessage = "";

requireLogin();
redirectIfAdmin();

function handleDeleteRequest(): string {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Erreur CSRF : Requête non autorisée.");
    }

    $password = $_POST['password'] ?? '';

    if (DeleteAccount($_SESSION['username'], $password)) {
        session_destroy();
        header("Location: ../index.php?bye=1");
        exit();
    }

    return "Suppression échouée. Vérifiez votre mot de passe.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errorMessage = handleDeleteRequest();
}

require '../views/account_suppression.php';