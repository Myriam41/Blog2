<?php

$imgHeader = '';
$pageTitle = '';
$subTitle = '';

// Page header little image
$imglittle = '';

ob_start();
var_dump($_SESSION['parentId']);
?>
    <div class="bloccomments">
<?php
        require '../src/view/template/commentAdd.php';?>
    </div>
<?php

$content = ob_get_clean();

    require '../src/view/template/default.php';
