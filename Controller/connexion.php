<?php
ini_set('session.cookie_httponly', 1);
session_start();
if (!isset($_SESSION['connected']) || !function_exists($_SESSION['connected'])) {

    require '../Views/disconnect_navbar.php';
    require '../views/connexion.php';
    require_once '../SQL_Request/Select.php';

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $check = ConnectSelect($username, $password); // si check est à True, l'utilisateur peut être connecté

    if ($check) {
        $_SESSION['username'] = $username;
        header('Location: ../views/dashboard.php');
        $connected = true;
        $_SESSION['connected'] = $connected;
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }

    } else {
    // Envoi du header 404 Not Found
    require '../Views/404.php';
}
