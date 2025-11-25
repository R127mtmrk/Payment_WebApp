<?php
require_once 'cookie_param.php';
require_once '../SQL_Request/Select.php';
session_start();

$errorMessage = "";

if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
    header('Location: ../views/dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $user = ConnectSelect($username, $password);

    if ($user) {
        session_regenerate_id(true);

        $_SESSION['connected'] = true;
        $_SESSION['username'] = $user['psd_user'];
        $_SESSION['id_user'] = $user['id_user'];

        header('Location: ../views/dashboard.php');
        exit();
    } else {
        $errorMessage = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

require '../views/connexion.php';
?>