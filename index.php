<?php
ini_set('session.cookie_httponly', 1);

session_start();

if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
    header('Location: Controller/dashboard.php');
    exit();
} else {
    header('Location: Controller/connexion.php');
    exit();
}