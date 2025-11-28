<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Historique - Dashboard</title>
    <link rel="stylesheet" href="../Views/assets/css/navbar.css">
    <link rel="stylesheet" href="../Views/assets/css/style.css">
</head>
<body>
<?php include 'connect_navbar.php'; ?>

<div class="body-container">
    <div class="container dashboard-width">

        <div class="dashboard-header">
            <div>
                <h2>Mes Paiements</h2>
                <div class="user-greeting">
                    Bonjour <?= htmlspecialchars($_SESSION['username']) ?>
                </div>
            </div>
            <a href="../Controller/Transaction.php" class="btn-primary">
                + Nouvelle Transaction
            </a>
        </div>

        <?php if (empty($history)): ?>
            <p class="empty-row">Aucune transaction effectuée pour le moment.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="transac-table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Destinataire</th>
                        <th>Carte Utilisée</th>
                        <th>Message</th>
                        <th>Montant</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($history as $transac): ?>
                        <tr>
                            <td><?= date('d/m/Y H:i', strtotime($transac['date_transac'])) ?></td>

                            <td>
                                <?= htmlspecialchars($transac['receiver_name'] ?? 'Inconnu') ?>
                                <?php if(isset($transac['refund_transac']) && (int)$transac['refund_transac'] === 1): ?>
                                    <br><span class="badge-refund">Remboursé</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if (!empty($transac['num_card'])): ?>
                                    <span class="card-info">
                                            <?= htmlspecialchars($transac['card_display_first']) ?>
                                            **** **** <?= htmlspecialchars($transac['num_card']) ?>
                                    </span>
                                    <br>
                                    <small class="card-exp">Exp: <?= htmlspecialchars($transac['expiration_date']) ?></small>
                                <?php else: ?>
                                    <span class="sys-msg">Système / Remboursement</span>
                                <?php endif; ?>
                            </td>

                            <td class="message-content">
                                <?= htmlspecialchars($transac['msg_transac']) ?>
                            </td>

                            <td class="amount-debit">
                                -<?= number_format($transac['sum_transac'], 2, ',', ' ') ?> €
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </div>
</div>
</body>
</html>