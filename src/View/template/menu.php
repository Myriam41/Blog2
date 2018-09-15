<?php

// Menu connection user OK=1

if ($_SESSION['connect'] === 1) {
    ?>  
    <i class="fa fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=home">Accueil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=postList">Articles</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="index.php?page=contact">Contact</a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=login">Enregistrement</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=login">Déconnexion</a>
        </li>
        </ul>
    </div>
<?php
}

// Menu connection visitor NO=0
 
else {
    ?>
        <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=home">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=postList">Articles</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="index.php?page=contact">Contact</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=login">Connexion</a>
            </li>
            </ul>
        </div>
    <?php
}
