<?php
require_once 'init.php';

requireLogin();

// --- ADMIN ---
    if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['refund_id'])) {

            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die("Erreur CSRF : Requête non autorisée.");
            }

            $idTransac = (int)$_POST['refund_id'];
            $result = MakeRefund($idTransac);
            if ($result === true) {
                $successMessage = "Transaction #$idTransac remboursée avec succès.";
            } else {
                $errorMessage = $result;
            }
        }
        $allTransactions = SelectAllTransactions();
        require '../Views/admin_dashboard.php';
    } // --- LOGIQUE UTILISATEUR STANDARD ---
    else {
        $transactions = SelectUserTransactions($_SESSION['id_user']);
        $history = [];
        foreach ($transactions as $row) {
            $firstFour = "****";
            if (!empty($row['pan_encrypted']) && !empty($row['pan_iv']) && defined('ENCRYPTION_KEY')) {
                try {
                    $iv = hex2bin($row['pan_iv']);
                    $decryptedPan = openssl_decrypt(
                        $row['pan_encrypted'],
                        'aes-256-cbc',
                        ENCRYPTION_KEY,
                        0,
                        $iv
                    );
                    if ($decryptedPan) {
                        $firstFour = substr($decryptedPan, 0, 4);
                    }
                } catch (Exception $e) {
                }
            }
            $row['card_display_first'] = $firstFour;
            $history[] = $row;
        }
        require '../Views/dashboard.php';
    }
