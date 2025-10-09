<?php
require '../views/connexion.php';
require_once '../SQL_Request/Select.php';

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$check = ConnectSelect($username, $password); // si check est à True, l'utilisateur peut être connecté

if($check){
    session_start();
    $_SESSION['username'] = $username;
    header('Location: ../views/dashboard.php');
    $connected = true;
    $_SESSION['connected'] = $connected;
} else {
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}