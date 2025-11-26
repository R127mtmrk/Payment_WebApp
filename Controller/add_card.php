<?php
require_once 'cookie_param.php';
require_once 'function.php';
session_start();
if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {

    require '../Views/add_card.php';
    $card_number = isset($_POST['card_number']) ? htmlspecialchars($_POST['card_number']) : '';
    $expiry_date = isset($_POST['expiry_date']) ? htmlspecialchars($_POST['expiry_date']) : '';

    $card_number = str_replace(['-', ' '], '', $card_number);
    $expiry_date = str_replace(['/', ' '], '', $expiry_date);

    if (numberCard($card_number) && (dateExpiry($expiry_date))){
            // TODO: faire les requetes SQL pour ajouter la carte
        }

} else {
    // Envoi du header 404 Not Found
    require '../Views/404.php';
}