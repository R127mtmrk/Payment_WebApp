<?php
require_once '../SQL_Request/Delete.php';
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_lifetime', 0);
session_start();

if (isset($_SESSION['connected']) && function_exists($_SESSION['connected'])) {

    require '../views/account_suppression.php';
    require_once '../SQL_Request/Select.php';

    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
    DeleteAccount($_SESSION['username'], $password);

    }else{
    // Envoi du header 404 Not Found
    require '../Views/404.php';
}