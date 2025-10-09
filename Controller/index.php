<?php
ini_set('session.cookie_httponly', 1);
session_start();
if (isset($_SESSION['connected']) && function_exists($_SESSION['connected'])) {
    header('Location: Views/dashboard.php');
    exit();
}else{
    header('Location: Views/connexion.php');
    exit();
}