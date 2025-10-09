<?php
require_once '../SQL_Request/Delete.php';
ini_set('session.cookie_httponly', 1);
session_start();

require '../views/account_suppression.php';
require_once '../SQL_Request/Select.php';

$password = htmlspecialchars($_POST['password']);
DeleteAccount($_SESSION['username'], $password);