<?php
require_once 'init.php';
require_once '../SQL_Request/Delete.php';

$errorMessage = "";

redirectIfConnected();

redirectIfAdmin();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Erreur CSRF : Requête non autorisée.");
        }

        $password = $_POST['password'] ?? '';

        if (DeleteAccount($_SESSION['username'], $password)) {
            session_destroy();
            header("Location: ../index.php?bye=1");
            exit();
        } else {
            $errorMessage = "Suppression échouée. Vérifiez votre mot de passe.";
        }
    }
    require '../views/account_suppression.php';
