<?php
require '../views/connexion.php';

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

//TODO faire les requettes SQL