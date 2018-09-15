<?php
use App\Entity\Log;

$imgHeader = '../img/chouette_vol_640x420.jpg';
$pageTitle = 'Développez votre avenir';
$subTitle = '';

// Page header little image
$imglittle = '';

ob_start();?>

<div class = "container-fluid">
    <!-- first line : logo, introduce, photo and links -->
    <div class = "row">
        <div class = "col-lg-3 col-md-12 col-sm-12 col-xs-12 text-center">
            <img id="logo2" src="../img/Stamp200.png"  alt="Stamp Devlopment"/>
        </div>

        <div class = "col-lg-6 col-md-12 col-sm-12 col-xs-12 text-center" id="introduce">
            <h3>Stamp Devlopment</h3>
            <br/>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text center">
                    <h4> Applications </h4>
                    <br/>
                    <h5> Filemaker </h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text center">
                    <h4> Sites WEB</h4>
                    <br/>
                    <h5> Wordpress </h5>
                    <h5> PHP </h5>
                </div>
            </div>
        </div>
        <div class = "col-lg-3 col-md-12 col-sm-12 col-xs-12 text-center">
            <p>Myriam Stampers</p>
            <img id="mimi" src="../img/myr2R.png"  alt="Photo du développeur"/>
            <a class="nav-link" target="_blank" href="../doc/cv 2018 informatique.pdf">Mon CV</a>
            <a class="nav-link" href="index.php?page=postList">Articles</a>
        </div>
    </div>
    <br/>
    <!-- second line : contact form -->
    <div class = "row">
        <div class = "col-lg-3 col-md-12 col-sm-12 col-xs-12 text-center">
        </div>

        <form class = "col-lg-offset-3 col-lg-5 col-md-offset-5 col-md-7 col-sm-12 col-xs-12" method="post" action="index.php?page=formHome" onsubmit="votre message a bien été envoyé. Nous vous contacterons rapidement">
            <legend> Un projet ? une question ? Envoyez-moi un message </legend>
                <div class="form-group">
                    <label for="name">Nom :</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">email :</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="message">Message :</label>
                    <input type="text" name="message" id="message" class="form-control">
                </div>

                <input type="submit" name="sendmail" value="Envoyer"/>
        </form>

         <div class = "col-lg-3 col-md-12 col-sm-12 col-xs-12 text-center">
        </div>
    </div>
</div>
<?php

$content = ob_get_clean();

require('../src/View/template/default.php');
