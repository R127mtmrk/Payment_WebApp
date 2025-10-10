<?php
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_SESSION['connected']) && function_exists($_SESSION['connected'])) {

    require '../Views/connect_navbar.php';
    require '../Views/dashboard.php';

} else {
    require '../Views/404.php';
}