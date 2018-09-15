<?php
use App\Entity\Post;

foreach ($comments as $comment) {?>
    <div class="container">
    <div class="row">

    <div class="col-lg-8 col-md-10 mx-auto">
        <span class="post-meta">Posté par 
            <?= htmlspecialchars($comment['pseudo']); ?> le 
            <?= htmlspecialchars($comment['createdAt']); ?></span></br>

        <article> <?= htmlspecialchars($comment['contmessage']); ?></article>
    </div>
        <ul class='comment-button'>
            <li class="nav-comment">
                <a class="nav-link" href="index.php?page=reply_comment&id=<?= $comment['comment_id']?>">Répondre</a>
            </li>

    <?php   //seul l'utilisateur ayant créé le commentaire peut le odifier ou le supprimer
            if ($comment['pseudo'] === $_SESSION['pseudo']){?>
                <li class="nav-comment">
                    <a class="nav-link" href="index.php?page=edit_comment&id=<?= $comment['comment_id']?>">Modifier</a>
                </li>
                <li class="nav-comment">
                    <a class="nav-link" href="index.php?page=delete_comment&id=<?= $comment['comment_id']?>">Supprimer</a>
                </li>
    <?php   } ?>
        </ul>
    </div>
    </div>
    
    <br/>
    <?php
    foreach ($replies as $reply) {
        if($comment['comment_id'] == $reply['parentId']){?>
            <div class="container_reply">
            <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <span class="post-meta">Posté par 
                    <?= htmlspecialchars($reply['pseudo']); ?> le 
                    <?= htmlspecialchars($reply['createdAt']); ?></span></br>

                <article> <?= htmlspecialchars($reply['contmessage']); ?></article>
            </div>
            
            <ul class='comment-button'>
<?php       //seul l'utilisateur ayant créé le commentaire peut le odifier ou le supprimer
            if ($comment['pseudo'] === $_SESSION['pseudo']){?>
                <li class="nav-comment">
                    <a class="nav-link" href="index.php?page=edit_comment&id=<?= $reply['comment_id']?>">Modifier</a>
                </li>
                <li class="nav-comment">
                    <a class="nav-link" href="index.php?page=delete_comment&id=<?= $reply['comment_id']?>">Supprimer</a>
                </li>
<?php       } ?>
            </ul>
            </div>
            </div>

 
<?php
        }
        
    }
}