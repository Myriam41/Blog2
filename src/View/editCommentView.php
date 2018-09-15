<?php

$imgHeader = '';
$pageTitle = '';
$subTitle = '';

// Page header little image
$imglittle = '';

ob_start();
foreach ($comment as $data) {
    ?>
    <div class="bloccomments">  
    <form action="index.php?page=commentEdit&id=<?=$_SESSION['commentId']; ?>" method="post" class="col-lg-10">
        <legend>Modifier mon commentaire</legend>
            <fieldset>
                <div class="form group">  
                    <label>Message : </label>
                    <textarea id="contmessage" name="contmessage" class="form-control" rows="4" cols="50"><?= $data['contmessage'];?></textarea>
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
