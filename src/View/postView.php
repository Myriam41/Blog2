<?php
foreach ($post as $article) {
    $imgHeader = esc_html('');
    $pageTitle = esc_html($article['title']);
    $subTitle = esc_html($article['introduction']);

    // Page header little image
    $imglittle = esc_html('');

    ob_start();
    //_____________Display Post______________________
        require '../src/view/template/post.php'; ?>

    <div class="bloccomments">
        <h3>commentaires</h3>
<?php
            //________Display comments et replies__________
            require '../src/view/template/comment.php'; ?>
    </div>
    
    <div class='row'>
<?php
    //____________Display commentAdd___________________
    require '../src/view/template/commentAdd.php';
?>
    </div>
    <div class='row'>
    </div>

<?php

$content = ob_get_clean();

    require '../src/view/template/default.php';
}
