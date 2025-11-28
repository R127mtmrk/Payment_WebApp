<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<header class="site-header">
    <div class="navbar container-large">
        <nav>
            <ul class="menu">
                <li>
                    <a href="../Controller/dashboard.php" class="under_ligne <?= ($currentPage === 'dashboard.php') ? 'active' : '' ?>">Dashboard</a>
                </li>
                <li>
                    <a href="../Controller/Transaction.php" class="under_ligne <?php if ($currentPage === 'Transaction.php') { echo 'active'; } ?>">Transaction</a>
                </li>
                <li>
                    <a href="../Controller/disconnected.php" class="under_ligne <?php if ($currentPage === 'disconnected.php') { echo 'active'; } ?>">Déconnexion</a>
                </li>
                <li>
                    <a href="../Controller/account_suppression.php" class="under_ligne <?php if ($currentPage === 'account_suppression.php') { echo 'active'; } ?>">Supprimer mon compte</a>
                </li>
                <li>
                    <a href="../Controller/add_card.php" class="under_ligne <?php if ($currentPage === 'add_card.php') { echo 'active'; } ?>">Ajouter une carte</a>
                </li>
            </ul>
        </nav>
    </div>
</header>