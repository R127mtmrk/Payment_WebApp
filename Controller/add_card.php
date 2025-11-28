<?php
require_once 'init.php';

$successMessage = "";
$errorMessage = "";

redirectIfConnected();

redirectIfAdmin();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Erreur CSRF : Requête non autorisée.");
        }

        $card_number = isset($_POST['card_number']) ? htmlspecialchars($_POST['card_number']) : '';
        $expiry_date = isset($_POST['expiry_date']) ? htmlspecialchars($_POST['expiry_date']) : '';
        $card_number_clean = str_replace(['-', ' '], '', $card_number);
        $expiry_date_clean = str_replace(['/', ' '], '', $expiry_date);

        if (numberCard($card_number_clean) && dateExpiry($expiry_date_clean)) {


            if (InsertCard($_SESSION['username'], $card_number_clean, $expiry_date_clean)) {

                $successMessage = "Carte ajoutée avec succès !";

            } else {

                $errorMessage = "Erreur technique ou carte déjà existante.";

            }

        } else {

            $errorMessage = "Format invalide. Numéro : 16 chiffres. Date : MM/AA.";

        }
    }
    require '../Views/add_card.php';
