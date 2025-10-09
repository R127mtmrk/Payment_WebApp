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
        <title>Connexion</title>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
    <div class="container">
        <h2>Connexion</h2>
        <form action="../Controller/index.php" method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur ou adresse mail</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Se connecter</button>
        </form>
        <p>Pas encore de compte ? <a href="inscription.php">Inscrivez-vous ici</a></p>
    </div>
    </body>
    </html>
<?php } else {
// Envoi du header 404 Not Found
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1><p>La ressource demandée est introuvable.</p>";
    exit();
}
?>