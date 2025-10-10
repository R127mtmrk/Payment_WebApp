<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../Views/assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Connexion</h2>
    <form action="../index.php" method="POST">
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
    <p>Pas encore de compte ? <a href="../Controller/inscription.php">Inscrivez-vous ici</a></p>
</div>
</body>
</html>