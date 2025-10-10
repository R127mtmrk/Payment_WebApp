<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="../Views/assets/css/navbar.css">
</head>
<body>
<header class="site-header">
    <div class="navbar container-large">
        <nav>
            <ul class="menu">
                <li>
                    <a href="../Controller/dashboard.php" class="under_ligne <?php if ($currentPage === '../Controller/dashboard.php') echo 'active'; ?>">Dashboard</a>
                </li>
                <li>
                    <a href="../Controller/Transaction.php" class="under_ligne <?php if ($currentPage === '../Controller/Transaction.php') echo 'active'; ?>">Transaction</a>
                </li>
                <li>
                    <a href="../Controller/disconnected.php" class="under_ligne <?php if ($currentPage === '../Controller/disconnected.php') echo 'active'; ?>">Déconnexion</a>
                </li>
                <li>
                    <a href="../Controller/account_suppression.php" class="under_ligne <?php if ($currentPage === '../Controller/account_suppression.php') echo 'active'; ?>">Supprimer mon compte</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
</body>