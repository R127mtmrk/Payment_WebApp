<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../Views/assets/css/navbar.css">
    <link rel="stylesheet" href="../Views/assets/css/style.css">
    <script src="../Views/assets/js/connexion.js" defer></script>
</head>
<body>
<?php include 'disconnect_navbar.php'; ?>
<div class="body-container">
    <div class="container">
        <h2>Connexion</h2>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert error">
                <?= htmlspecialchars($errorMessage) ?>
            </div>
        <?php endif; ?>

        <div id="jsErrorContainer" class="alert error hidden"></div>

        <form action="" method="POST" id="loginForm" novalidate>
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <div class="form-group">
                <label for="username">Nom d'utilisateur ou adresse mail</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password">
            </div>

            <button type="submit">Se connecter</button>
        </form>

        <p>Pas encore de compte ? <a href="../Controller/inscription.php">Inscrivez-vous ici</a></p>
    </div>
</div>
</body>
</html>