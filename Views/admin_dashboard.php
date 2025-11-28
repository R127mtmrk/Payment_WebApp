<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Paiements</title>
    <link rel="stylesheet" href="../Views/assets/css/navbar.css">
    <link rel="stylesheet" href="../Views/assets/css/style.css">
</head>
<body>
<?php include 'admin_navbar.php'; ?>

<div class="body-container">
    <div class="container dashboard-width">

        <div class="dashboard-header">
            <h2>Administration des Transactions</h2>
            <div class="user-greeting">
                Bonjour <?= htmlspecialchars($_SESSION['username']) ?>
            </div>
        </div>

        <?php if (!empty($successMessage)): ?>
            <div class="alert success"><?= htmlspecialchars($successMessage) ?></div>
        <?php endif; ?>
        <?php if (!empty($errorMessage)): ?>
            <div class="alert error"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="transac-table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>De (Envoyeur)</th>
                    <th>Vers (Reçu par)</th>
                    <th>Carte (Fin / Exp)</th>
                    <th>Message</th>
                    <th>Montant</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($allTransactions)): ?>
                    <tr><td colspan="7" class="empty-row">Aucune transaction dans le système.</td></tr>
                <?php else: ?>
                    <?php foreach ($allTransactions as $t): ?>
                        <tr>
                            <td><?= date('d/m/y H:i', strtotime($t['date_transac'])) ?></td>

                            <td><?= htmlspecialchars($t['sender_name'] ?? 'Système') ?></td>

                            <td><?= htmlspecialchars($t['receiver_name'] ?? 'Inconnu') ?></td>

                            <td>
                                <?php if (!empty($t['num_card'])): ?>
                                    <span class="card-info">
                                        **** **** **** <?= htmlspecialchars($t['num_card']) ?>
                                    </span>
                                    <br>
                                    <small class="card-exp">Exp: <?= htmlspecialchars($t['expiration_date']) ?></small>
                                <?php else: ?>
                                    <span class="sys-msg">--</span>
                                <?php endif; ?>
                            </td>

                            <td class="message-content">
                                <?= htmlspecialchars_decode($t['msg_transac']) ?>
                            </td>

                            <td class="amount-bold">
                                <?= number_format($t['sum_transac'], 2) ?> €
                            </td>

                            <td>
                                <?php if ($t['refund_transac'] === 1): ?>
                                    <span class="badge-refund">Remboursé</span>
                                <?php elseif ($t['sum_transac'] > 0 && !empty($t['id_card_used'])): ?>
                                    <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir rembourser cette transaction ?');">
                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                        <input type="hidden" name="refund_id" value="<?= $t['id_transac'] ?>">
                                        <button type="submit" class="btn-refund">Rembourser</button>
                                    </form>
                                <?php else: ?>
                                    <span class="sys-msg">N/A</span>
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
</body>
</html>