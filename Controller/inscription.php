<?php
require '../views/inscription.php';
require '../SQL_Request/Insert.php';

$username = htmlspecialchars($_POST['username']);
$mail = htmlspecialchars($_POST['mail']);
$password = htmlspecialchars($_POST['password']);
$password_confirm = htmlspecialchars($_POST['password_confirm']);

if ($password != $password_confirm) {

} else {

}