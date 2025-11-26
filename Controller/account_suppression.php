<?php
require_once '../SQL_Request/Delete.php';
require_once 'cookie_param.php';
session_start();

if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {

    require '../views/account_suppression.php';
    require_once '../SQL_Request/Select.php';

    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
    DeleteAccount($_SESSION['username'], $password);

    }else{
    // Envoi du header 404 Not Found
    require '../Views/404.php';
}