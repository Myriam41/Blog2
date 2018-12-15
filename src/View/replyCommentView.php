<?php

// Page header little image

ob_start();?>
    <div class="bloccomments">
<?php
        require '../src/view/template/commentAdd.php';?>
    </div>
<?php

$content = ob_get_clean();

    require '../src/view/template/default.php';
