<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<header class="site-header">
    <div class="navbar container-large">
        <nav>
            <ul class="menu">
                <li>
                    <a href="../Controller/dashboard.php" class="under_ligne <?php if ($currentPage === 'dashboard.php') { echo 'active'; } ?>">Dashboard</a>
                </li>
                <li>
                    <a href="../Controller/disconnected.php" class="under_ligne <?php if ($currentPage === 'disconnected.php') { echo 'active'; } ?>">Déconnexion</a>
                </li>
            </ul>
        </nav>
    </div>
</header>