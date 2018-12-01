<?php

ob_start();
?>
<hr>
<div class="row">
<?php
    if ($_SESSION['userId']!=0) {
        ?>
        <p><a class="" href="index.php?page=postNew">Ajouter un article</a></p>
    <?php
    }?>
</div>

<div class="row">    
    <?php
    // Main Content last 10 posts
    foreach ($posts as $post) {
        ?>     
        <div class="col-lg-6 col-md-6 mx-auto">
            <div class="postTitle">
                <a href="index.php?id=<?= $post['post_id']?>&amp;page=post">
                    <h2 >
                        <?= esc_attr($post['title']); ?>
                    </h2>
                </a>
            </div>
                <h3 class="post-subtitle">
                    <?= esc_attr($post['introduction']); ?>
                </h3>
                
                <span class="post-meta">
                    écrit par
                    <?= esc_attr($post['author']); ?>
                    Posté par
                    <?= esc_attr($post['pseudo']); ?>
                    le 
                    <?= esc_attr($post['createdAt']);

        if (isset($post['updateAt'])) {
            ?>
                            . Mis à jour le 
                            <?= esc_attr($post['updateAt']); ?>
                    <?php
        } ?>  
                </span>
                <br/>

                <a href="index.php?id=<?= esc_url($post['post_id'])?>&amp;page=post">Lire l'article</a>
        </div>
        <?php
    } ?>
</div>

<?php

$content = ob_get_clean();

require('../src/View/template/default2.php');
