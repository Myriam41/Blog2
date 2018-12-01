<?php

$_SESSION['postId' ]= esc_attr($article['postId']);

//!-- Main Content --?>
<div class="container">
<div class="row">
    <div class="col-lg-10 col-md-11 mx-auto">
        <span class="post-meta">
        écrit par
        <?= esc_attr($article['author']); ?> 
        Posté par 
        <?= esc_attr($article['pseudo']); ?> le 
        <?= esc_attr($article['createdAt']);

        if (isset($article['updateAt'])) {
            ?>
            . Mis à jour le 
            <?= esc_attr($article['updateAt']); ?></span><br/><br/>
<?php
        }?>

        <article> <?= esc_attr($article['content']); ?></article>
    </div>
</div>

<?php
if ($_SESSION['connect']==1 && $_SESSION['status']== 1) {
            ?>
    <div class="col-lg-10 col-md-11 mx-auto">
    <div class="row">
        <div class="nav-comment">
            <a class="nav-link" href="index.php?page=edit_post&id=<?= esc_url($article['postId'])?>">Modifier</a>
        </div>
        <div class="nav-comment">
            <a class="nav-link" href="index.php?page=delete_post&id=<?= esc_url($article['postId'])?>">Supprimer</a>
        </div>
    </div> 
    </div>
<?php
        }  ?>
</div>
