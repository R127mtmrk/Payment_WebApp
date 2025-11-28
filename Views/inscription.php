<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../Views/assets/css/navbar.css">
    <link rel="stylesheet" href="../Views/assets/css/style.css">
    <script src="../Views/assets/js/inscription.js" defer></script>
</head>
<body>
<?php include 'disconnect_navbar.php'; ?>

<div class="body-container">
    <div class="container">
        <h2>Inscription</h2>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert error"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>

        <?php if (!empty($successMessage)): ?>
            <div class="alert success"><?= htmlspecialchars($successMessage) ?></div>
        <?php endif; ?>

        <div id="jsErrorContainer" class="alert error hidden"></div>

        <form action="" method="POST" id="inscriptionForm" novalidate>
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="usermail">Adresse mail</label>
                <input type="text" id="usermail" name="usermail" value="<?= htmlspecialchars($_POST['usermail'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="password_create">Mot de passe</label>
                <input type="password" id="password_create" name="password_create">
                <small id="pwdHelper" class="helper-text"></small>
            </div>

            <div class="form-group">
                <label for="password_confirm">Confirme le mot de passe</label>
                <input type="password" id="password_confirm" name="password_confirm">
                <small id="confirmHelper" class="helper-text text-error"></small>
            </div>

            <button type="submit" id="submitBtn">S'inscrire</button>
        </form>

        <p>Déjà un compte ? <a href="../Controller/connexion.php">Connectez-vous ici</a></p>
    </div>
</div>
</body>
</html>