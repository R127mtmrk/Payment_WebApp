<?php
require_once 'cookie_param.php';
session_start();

$message_transact = isset($_POST['message_transact']) ? htmlspecialchars($_POST['message_transact']) : '';

if (isset($_SESSION['connected']) && function_exists($_SESSION['connected'] === true)) {

    require '../Views/transaction.php';

    } else {
    // Envoi du header 404 Not Found
    require '../Views/404.php';
}