<?php
require_once 'init.php';

$errorMessage = "";

redirectIfConnected();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Erreur CSRF : Requête non autorisée.");
        }

        // Nettoyage des entrées
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $errorMessage = "Veuillez remplir tous les champs.";
        } else {
            $user = ConnectSelect($username, $password);

            if ($user) {
                session_regenerate_id(true);

                $_SESSION['connected'] = true;
                $_SESSION['username'] = $user['psd_user'];
                $_SESSION['id_user'] = $user['id_user'];

                $_SESSION['admin'] = ($user['role_user'] === 1);

                header('Location: dashboard.php');
                exit();
            } else {
                $errorMessage = "Nom d'utilisateur ou mot de passe incorrect.";
            }
        }
    }

    require '../Views/connexion.php';
