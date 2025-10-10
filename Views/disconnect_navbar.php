<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<header class="site-header">
    <div class="navbar container-large">
        <nav>
            <ul class="menu">
                <li>
                    <a href="../Controller/connexion.php" class="under_ligne <?php if ($currentPage === '../Controller/connexion.php') echo 'active'; ?>">Connexion</a>
                </li>
                <li>
                    <a href="../Controller/inscription.php" class="under_ligne <?php if ($currentPage === '../Controller/inscription.php') echo 'active'; ?>">Inscription</a>
                </li>
            </ul>
        </nav>
    </div>
</header>