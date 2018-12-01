<?php
foreach ($post as $data) {
    $imgHeader = esc_html('');
    $pageTitle = esc_html($data['title']);
    $subTitle = esc_html($data['introduction']);

    // Page header little image
    $imglittle = esc_html('');

    ob_start(); ?>
    <div class="bloccomments">  
    <form action="index.php?page=postEdit&id=<?= esc_url($_SESSION['postId']); ?>" method="post" class="col-lg-10">
        <legend>Modifier mon article</legend>
        <fieldset>
            <div class="form group">  
                <label>Titre: </label>
                <textarea id="title" name="title" type="text" class="form-control" rows="1" cols="50"><?= esc_attr($data['title']); ?></textarea> 
            </div>

            <div class="form group">  
                <label>chapo : </label>
                <textarea id="introduction" name="introduction" type="text" class="form-control" rows="1" cols="50"><?= esc_attr($data['introduction']); ?></textarea> 
            </div>

            <div class="form group">  
                <label>Auteur : </label>
                <textarea id="author" name="author" type="text" class="form-control" rows="1" cols="50"><?= esc_attr($data['author']); ?></textarea> 
            </div>

            <div class="form group">  
                <label>Article : </label>
                <textarea id="content" name="content" class="form-control" rows="4" cols="50"><?= esc_attr($data['content']); ?></textarea> 
            </div>
<?php
}?>
    <br/>
        <div class="form-group">
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Envoyer</button>
        </div>
        </fieldset>
    </form>
    </div>
<?php

$content = ob_get_clean();

    require '../src/view/template/default.php';
