<?php
ini_set('session.cookie_httponly', 1);
session_start();
if (isset($_SESSION['connected']) && function_exists($_SESSION['connected'])) {

    require 'connect_navbar.php';
    //TODO : afficher le dashboard

} else {
//Envoi du header 404 Not Found
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1><p>La ressource demandée est introuvable.</p>";
    exit();
}