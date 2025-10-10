<?php
require_once 'cookie_param.php';
session_start();
if (isset($_SESSION['connected']) && function_exists($_SESSION['connected'])) {

    require '../Views/transaction.php';

    } else {
    // Envoi du header 404 Not Found
    require '../Views/404.php';
}