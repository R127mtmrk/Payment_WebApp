<?php
ini_set('session.cookie_httponly', 1);
session_start();
if (!isset($_SESSION['connected']) || !function_exists($_SESSION['connected'])) {
require 'disconnect_navbar.php';
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
    <div class="container">
        <h2>Inscription</h2>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="usermail">Adresse mail</label>
                <input type="email" id="usermail" name="usermail" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirm">Confirme le mot de passe</label>
                <input type="password" id="password_confirm" name="password_confirm" required>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà un compte ? <a href="connexion.php">Connectez-vous ici</a></p>
    </div>
    </body>
    </html>
<?php } else {
// Envoi du header 404 Not Found
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1><p>La ressource demandée est introuvable.</p>";
    exit();
}?>