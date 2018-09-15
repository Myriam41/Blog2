<?php

$imgHeader = '../img/chouette_vol_640x420.png';
$pageTitle = 'Ecrire';
$subTitle = 'partager ses connaisances';

// Page header little image
$imglittle = '';

ob_start();?>

  <!-- Main Content -->
  <div class="well">
  <form action="index.php?page=postAdd" method="post" class="col-lg-10">
    <legend>Ecrire un nouvel article</legend>
    <fieldset>
      <div class="form group">
        <label for "title">Titre : </label>
        <input id="title" name="title" type="text" class="form-control" placeholder="Titre" required data-validation-required-message="Merci de donner un titre.">
      </div>
      <div class="form group">   
        <label for "intro">Introduction : </label>
        <input id="intro" name="introduction" type="text" class="form-control" placeholder="Introduction" required data-validation-required-message="Merci d'écrire une introduction.">
      </div>
      <div class="form group">  
        <label for "content">Texte : </label>
      <textarea id="content" name="content" class="form-control" rows="4" cols="50"></textarea> </div>
      
</br>
      <div class="form-group">
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Envoyer</button>
      </div>
  </fieldset>
    </form>
  </div>

<?php

$content = ob_get_clean();

require('../src/View/template/default.php');
