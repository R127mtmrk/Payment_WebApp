<?php
require_once 'init.php';

requireLogin();

$successMessage = "";
$errorMessage = "";

// ==================================================
//               LOGIQUE ADMINISTRATEUR
// ==================================================
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['refund_id'])) {

        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Erreur de sécurité (CSRF) : Requête non autorisée.");
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

}
// ==================================================
//               LOGIQUE UTILISATEUR
// ==================================================
else {
    $userId = $_SESSION['id_user'];

    // 1. Récupérer les transactions (Envoyées ET Reçues)
    $transactions = SelectUserTransactions($userId);

    // 2. INITIALISATION DU SOLDE
    $solde = 0.0;
    $history = [];

    foreach ($transactions as $row) {

        // --- CALCUL DU SOLDE ---
        if ((int)$row['id_receiver'] === $userId) {
            $solde += (float)$row['sum_transac'];
        } else {
            $solde -= (float)$row['sum_transac'];
        }

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
