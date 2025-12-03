<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Paiements</title>
    <link rel="stylesheet" href="../Views/assets/css/navbar.css">
    <link rel="stylesheet" href="../Views/assets/css/style.css">
    <script src="../Views/assets/js/admin_dashboard.js" defer></script>
</head>
<body>
<?php include 'admin_navbar.php'; ?>

<div class="toast-container">
    <?php if (!empty($successMessage)): ?>
        <div class="toast success"><div>✔</div><div><?= htmlspecialchars($successMessage) ?></div></div>
    <?php endif; ?>
    <?php if (!empty($errorMessage)): ?>
        <div class="toast error"><div>✖</div><div><?= htmlspecialchars($errorMessage) ?></div></div>
    <?php endif; ?>
</div>

<div class="body-container">
    <div class="container dashboard-width">
        <div class="dashboard-header">
            <h2>Administration des Transactions</h2>
            <div class="user-greeting">Bonjour <?= htmlspecialchars($_SESSION['username']) ?></div>
        </div>

        <div class="table-responsive">
            <table class="transac-table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Envoyeur</th>
                    <th>Receveur</th>
                    <th>Carte</th>
                    <th>Message</th>
                    <th>Montant</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($allTransactions)): ?>
                    <tr><td colspan="7" id="aucune_transaction">Aucune transaction.</td></tr>
                <?php else: ?>
                    <?php foreach ($allTransactions as $t): ?>
                        <tr>
                            <td><?= date('d/m/y H:i', strtotime($t['date_transac'])) ?></td>
                            <td><?= htmlspecialchars($t['sender_name'] ?? 'Système') ?></td>
                            <td><?= htmlspecialchars($t['receiver_name'] ?? 'Inconnu') ?></td>
                            <td><?= !empty($t['num_card']) ? '**** ' . htmlspecialchars($t['num_card']) : '--' ?></td>
                            <td class="message-content">
                                <?php
                                $allowed = '<b><i><em><strong><style><br><p><span><div>';
                                if (!empty($t['msg_transac'])){
                                    echo strip_tags($t['msg_transac'], $allowed);
                                }else {
                                    echo '<span class="aucun_message">Aucun message</span>';
                                }
                                ?>
                            </td>
                            <td class="amount-bold"><?= number_format($t['sum_transac'], 2, ',', ' ') ?> €</td>
                            <td>
                                <?php if (isset($t['refund_transac']) && (int)$t['refund_transac'] === 1): ?>
                                    <span class="badge-refund">Remboursé</span>
                                <?php elseif ($t['sum_transac'] > 0): ?>
                                    <button type="button"
                                            class="btn-refund"
                                            onclick="openRefundModal(<?= $t['id_transac'] ?>)">
                                        Rembourser
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="refundModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-icon">⚠️</div>
        <div class="modal-title">Confirmation</div>
        <p class="modal-text">
            Voulez-vous vraiment rembourser cette transaction ?
            <br><br>
            <small class="irreversible">Cette action est irréversible.</small>
        </p>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeRefundModal()">Annuler</button>

            <form method="POST" action="" class="confirmer_remboursemnt">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="refund_id" id="refundIdInput">
                <button type="submit" class="btn-confirm">Confirmer</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>