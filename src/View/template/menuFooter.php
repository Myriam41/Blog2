<?php

// Menu connection user OK=1

if ($_SESSION['connect'] === 1) {
    ?>  
    <div class="navbar-collapse" id="navbarResponsive">
        <a class="nav-link" href="index.php?page=home">Accueil</a>
        <a class="nav-link" href="index.php?page=postList">Articles</a>
        <a class="nav-link" href="index.php?page=admin">Admin</a>
    </div>
<?php
}

// Menu connection visitor NO=0
 
else {
    ?>
    <div class="navbar-collapse" id="navbarResponsive">
        <a class="nav-link" href="index.php?page=home">Accueil</a>
        <a class="nav-link" href="index.php?page=postList">Articles</a>
    </div>
<?php
}
