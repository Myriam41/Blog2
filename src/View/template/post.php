<?php

    $_SESSION['postId' ]= $article['postId'];

    //!-- Main Content --?>
    <div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <span class="post-meta">Posté par 
            <?= htmlspecialchars($article['pseudo']); ?> le 
            <?= htmlspecialchars($article['createdAt']);
            if (isset($article['updateAt'])) {
                ?>
                . Mis à jour le 
                <?= htmlspecialchars($article['updateAt']); ?></span></br></br>
<?php
            }?>

            <article> <?= htmlspecialchars($article['content']); ?></article>
        </div>
    </div>

    <div class="row">
        <ul class='comment-button'>
<?php       //seul l'utilisateur ayant créé le post peut le modifier ou le supprimer
                if ($article['pseudo'] === $_SESSION['pseudo']) {
                    ?>
                    <li class="nav-comment">
                        <a class="nav-link" href="index.php?page=edit_post&id=<?= $article['postId']?>">Modifier</a>
                    </li>
                    <li class="nav-comment">
                        <a class="nav-link" href="index.php?page=delete_post&id=<?= $article['postId']?>">Supprimer</a>
                    </li>
    <?php
                } ?>
                </ul>
            </div>
    </div>