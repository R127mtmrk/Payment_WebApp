<?php
require_once 'init.php';

$errorMessage = "";
$successMessage = "";
$userCards = [];

requireLogin();

redirectIfAdmin();

$userId = $_SESSION['id_user'];

$userCards = SelectUserCards($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Erreur CSRF : Requête non autorisée.");
    }

    $receiver = trim($_POST['receiver'] ?? '');

    $amountRaw = str_replace(',', '.', $_POST['amount'] ?? '0');
    $amount = (float) $amountRaw;

    $id_card = isset($_POST['id_card']) ? (int) $_POST['id_card'] : 0;
    $cvv = trim($_POST['cvv'] ?? '');

    $message = $_POST['message_transact'] ?? '';

    $errors = [];

    if (empty($receiver)) {
        $errors[] = "Le destinataire est requis.";
    }

    if ($amount <= 0) {
        $errors[] = "Le montant doit être supérieur à 0.";
    }

    if (!preg_match('/^\d{3,4}$/', $cvv)) {
        $errors[] = "Le CVV est invalide (3 ou 4 chiffres requis).";
    }

    $cardBelongsToUser = false;
    if (!empty($userCards)) {
        foreach ($userCards as $card) {
            if ((int)$card['id_card'] === $id_card) {
                $cardBelongsToUser = true;
                break;
            }
        }
    }

    if (!$cardBelongsToUser) {
        $errors[] = "La carte sélectionnée est invalide ou ne vous appartient pas.";
    }

    if (!empty($errors)) {
        $errorMessage = $errors[0];
    } else {
        $receiverExists = SelectUser($receiver);

        if ($receiverExists) {

            $result = InsertTransaction($userId, $receiver, $amount, $id_card, $message);

            if ($result === true) {
                $successMessage = "Paiement effectué avec succès !";

                $_POST = [];
            } else {
                $errorMessage = $result;
            }

        } else {
            $errorMessage = "Ce destinataire n'existe pas. Veuillez vérifier le pseudo ou l'email.";
        }
    }
}

require '../Views/transaction.php';
