<?php
require_once 'cookie_param.php';
session_start();

if (isset($_SESSION['connected']) && function_exists($_SESSION['connected'])) {

    require '../Views/dashboard.php';

} else {
    require '../Views/404.php';
}