<?php
ini_set('session.cookie_httponly', 1);
session_start();
if (isset($_SESSION['connected']) && function_exists($_SESSION['connected'])) {

    require '../Views/add_card.php';
    $card_number = isset($_POST['card_number']) ? htmlspecialchars($_POST['card_number']) : '';
    $expiry_date = isset($_POST['expiry_date']) ? htmlspecialchars($_POST['expiry_date']) : '';
    $cvv = isset($_POST['cvv']) ? htmlspecialchars($_POST['cvv']) : '';

} else {
    // Envoi du header 404 Not Found
    require '../Views/404.php';
}