<?php

$_SESSION['postId' ]= $article['postId'];

//!-- Main Content --?>
<div class="container">
<div class="row">
    <div class="col-lg-10 col-md-11 mx-auto">
        <span class="post-meta">
        écrit par
        <?= htmlspecialchars($article['author']); ?> 
        Posté par 
        <?= htmlspecialchars($article['pseudo']); ?> le 
        <?= htmlspecialchars($article['createdAt']);

        if (isset($article['updateAt'])) {
            ?>
            . Mis à jour le 
            <?= htmlspecialchars($article['updateAt']); ?></span><br/><br/>
<?php
        }?>

        <article> <?= htmlspecialchars($article['content']); ?></article>
    </div>
</div>

<?php
if ($_SESSION['connect']=1 && $_SESSION['status']== 1) {
            ?>
    <div class="col-lg-10 col-md-11 mx-auto">
    <div class="row">
        <div class="nav-comment">
            <a class="nav-link" href="index.php?page=edit_post&id=<?= $article['postId']?>">Modifier</a>
        </div>
        <div class="nav-comment">
            <a class="nav-link" href="index.php?page=delete_post&id=<?= $article['postId']?>">Supprimer</a>
        </div>
    </div> 
    </div>
<?php
        }  ?>
</div>
