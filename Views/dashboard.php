<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Historique - Dashboard</title>
    <link rel="stylesheet" href="../Views/assets/css/navbar.css">
    <link rel="stylesheet" href="../Views/assets/css/style.css">
    <script src="../Views/assets/js/dashboard.js" defer></script>
</head>
<body>
<?php include 'connect_navbar.php'; ?>

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
            <div>
                <h2>Mon Compte</h2>
                <div class="user-greeting">
                    Heureux de vous revoir, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
                </div>
            </div>
            <a href="../Controller/Transaction.php" class="btn-primary">
                + Nouvelle Transaction
            </a>
        </div>

        <div class="balance-card">
            <div class="balance-title">Solde Actuel</div>
            <div class="balance-amount"><?= number_format($solde, 2, ',', ' ') ?> €</div>
            <!-- l'erreur est ok, car il sai juste pas d'où vient $solde -->
        </div>

        <h3>Historique récent</h3>

        <?php if (empty($history)): ?>
            <div class="empty-state">
                <p>Aucune transaction effectuée pour le moment.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="transac-table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Détails</th>
                        <th>Message</th>
                        <th>Montant</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($history as $transac): ?>
                        <?php
                        $isReceived = ((int)$transac['id_receiver'] === $_SESSION['id_user']);
                        $isRefunded = (isset($transac['refund_transac']) && (int)$transac['refund_transac'] === 1);
                        ?>
                        <tr>
                            <td><?= date('d/m/Y H:i', strtotime($transac['date_transac'])) ?></td>

                            <td>
                                <?php if ($isReceived): ?>
                                    <span class="transac-type type-received">Reçu</span>
                                <?php else: ?>
                                    <span class="transac-type type-sent">Envoyé</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if ($isReceived): ?>
                                    De : <strong><?= htmlspecialchars($transac['sender_name'] ?? 'Inconnu') ?></strong>
                                <?php else: ?>
                                    À : <strong><?= htmlspecialchars($transac['receiver_name'] ?? 'Inconnu') ?></strong>
                                    <?php if (!empty($transac['num_card'])): ?>
                                        <br>
                                        <span class="card-info">
                                            Carte : **** <?= htmlspecialchars($transac['num_card']) ?>
                                        </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>

                            <td class="message-content">
                                <?php
                                $allowed_tags = '<b><i><em><strong><br><p><span><div>';
                                if (!empty($transac['msg_transac'])) {
                                    echo strip_tags($transac['msg_transac'], $allowed_tags);
                                } else {
                                    echo '<span style="color:#ccc; font-style:italic;">Aucun message</span>';
                                }
                                ?>
                            </td>

                            <td class="<?= $isReceived ? 'amount-plus' : 'amount-minus' ?>">
                                <?= $isReceived ? '+' : '-' ?>
                                <?= number_format($transac['sum_transac'], 2, ',', ' ') ?> €
                            </td>

                            <td>
                                <?php if ($isRefunded): ?>
                                    <span class="badge-refund">Remboursé</span>
                                <?php elseif ($isReceived): ?>
                                    <button type="button"
                                            class="btn-refund"
                                            onclick="openRefundModal(<?= $transac['id_transac'] ?>)">
                                        Rembourser
                                    </button>
                                <?php else: ?>
                                    <span class="sys-msg">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </div>
</div>

<div id="refundModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-icon">⚠️</div>
        <div class="modal-title">Confirmer le remboursement</div>
        <p class="modal-text">
            Voulez-vous renvoyer l'argent à l'expéditeur ?<br>
            <br>
            <small style="color:#dc3545; font-weight:bold;">Le montant sera débité de votre solde.</small>
        </p>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeRefundModal()">Annuler</button>
            <form method="POST" action="" style="display:contents;">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="refund_id" id="refundIdInput">
                <button type="submit" class="btn-confirm">Confirmer</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>