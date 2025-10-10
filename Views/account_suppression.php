<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprime votre compte</title>
    <link rel="stylesheet" href="../Views/assets/css/navbar.css">
    <link rel="stylesheet" href="../Views/assets/css/style.css">
</head>
<body>
<?php include 'connect_navbar.php'; ?>
<div class="body-container">
    <div class="container">
        <h2>Supprime votre compte</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Supprime mon compte</button>
        </form>
    </div>
</div>
</body>
</html>