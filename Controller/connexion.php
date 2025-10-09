<?php
require '../views/connexion.php';
require_once '../SQL_Request/Select.php';

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$table = "users";

$check = ConnectSelect($username, $password); // si check est à True, l'utilisateur peut être connecté