<?php
use App\Entity\Log;

$imgHeader = '../img/chouette_vol_640x420.png';
$pageTitle = 'Développez votre avenir';
$subTitle = 'Myriam Stampers';

// Page header little image
$imglittle = '';

ob_start();?>
<div class="container-fluid">
    <div class = "row">
        <form class = "formlog col-lg-4 offset-lg-2 col-md-4 offset-md-2 col-sm-12 col-xs-12" method="post" action="index.php?page=formAddUser" onsubmit="votre message a bien été envoyé. Nous vous contacterons rapidement">
            <legend> Bulletin d'inscription</legend>
                <div class="form-group">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" name="pseudo" id="pseudo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">email :</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="pass">Mot de passe :</label>
                    <input type="password" name="pass" id="pass" class="form-control">
                </div>
                <div class="form-group">
                    <label for="confPass">confirmation :</label>
                    <input type="password" name="confPass" id="confPass" class="form-control">
                </div>

                <button type="submit">Envoyer</button>
        </form>
<!-- Déjà inscrit -->
        <form class="formlog col-lg-5 col-md-5 col-sm-12 col-xs-12" method="post" action="index.php?page=formLogin" onsubmit="votre message a bien été envoyé. Nous vous contacterons rapidement">
            <legend> Déjà inscrit</legend>
                <div class="form-group">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" name="pseudo" id="pseudo" class="form-control">
                </div>
            <div class="form-group">
                <label for="pass">Mot de passe :</label>
                <input type="password" name="pass" id="pass" class="form-control">
            </div>

            <button type="submit">Envoyer</button>
        </form>
    </div>
</div>

<?php

$content = ob_get_clean();

require('../src/View/template/default2.php');
