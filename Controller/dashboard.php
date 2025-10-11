<?php
require_once 'cookie_param.php';
session_start();

if (isset($_SESSION['connected']) && function_exists($_SESSION['connected'] === true)) {

    if (isset($_SESSION['admin']) && function_exists($_SESSION['admin'] === true)) {

        require '../Views/admin_dashboard.php';

    } else {
        require '../Views/dashboard.php';
    }


} else {
    require '../Views/404.php';
}