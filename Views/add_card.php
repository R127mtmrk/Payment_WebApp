<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une carte</title>
    <link rel="stylesheet" href="../Views/assets/css/navbar.css">
    <link rel="stylesheet" href="../Views/assets/css/style.css">
    <script defer src="../Views/assets/js/add_card.js"></script>
</head>
<body>
<?php include 'connect_navbar.php'; ?>

<div class="body-container">
    <div class="container">
        <h2>Ajouter une carte bancaire</h2>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert error"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>

        <?php if (!empty($successMessage)): ?>
            <div class="alert success"><?= htmlspecialchars($successMessage) ?></div>
            <a href="dashboard.php" class="back-link">Retour au tableau de bord</a>
        <?php else: ?>

            <form method="POST" action="">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <div class="form-group">
                    <label for="card_number">Numéro de carte</label>
                    <input type="text" id="card_number" name="card_number" required placeholder="XXXX XXXX XXXX XXXX" maxlength="19">
                </div>

                <div class="form-group">
                    <label for="expiry_date">Date d'expiration (MM/AA)</label>
                    <input type="text" id="expiry_date" name="expiry_date" required placeholder="MM/AA" maxlength="5">
                </div>

                <button type="submit">Enregistrer la carte</button>
            </form>

            <a href="dashboard.php" class="back-link">Annuler</a>

        <?php endif; ?>
    </div>
</div>
</body>
</html>