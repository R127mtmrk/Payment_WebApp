<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_lifetime', 0);
session_start();
if (isset($_SESSION['connected']) && function_exists($_SESSION['connected'])) {

    require '../Views/transaction.php';

    } else {
    // Envoi du header 404 Not Found
    require '../Views/404.php';
}