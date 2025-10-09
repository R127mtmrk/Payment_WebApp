<?php
require '../views/inscription.php';

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$password_confirm = htmlspecialchars($_POST['password_confirm']);

if ($password === $password_confirm) {
    //TODO faire les requettes SQL
}