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
        <form method="POST" action="../index.php">
            <div class="form-group">
                <label for="card_number">Numéro de carte</label>
                <input type="text" id="card_number" name="card_number" required>
            </div>
            <div class="form-group">
                <label for="expiry_date">Date d'expiration (MM/AA)</label>
                <input type="text" id="expiry_date" name="expiry_date" required>
            </div>

            <button type="submit">Envoyer</button>
        </form>
    </div>
</div>
</body>
</html>
