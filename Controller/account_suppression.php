<?php
session_start();

require '../views/account_suppression.php';
require_once '../SQL_Request/Select.php';

$_SESSION['username']; // Récupère le nom d'utilisateur de la session
$password = htmlspecialchars($_POST['password']);

//TODO : Faire la suppression du compte
