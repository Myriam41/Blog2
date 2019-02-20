<?php

$imgHeader = '';
$pageTitle = '';
$subTitle = 'Coin administration';

// Page header little image
$imglittle = '';

ob_start();?> 
    <div class='container'>
    <!--list of users displaying their name, and status and date registration-->
        liste des utilisateurs pour l'attribution des status<br/>
    <?php echo  $_SESSION['statusVal'] ;
    
            //création du tableau?>
            <table border ="1">
                <tr>          
                    <th scope="col">Utilisateur</th>
                    <th scope="col">Statut</th>
                </tr>

<?php   foreach ($users as $user) {
        ?>       
                        <tr>
<?php 
        
                            ?>
                            <td> <?php echo ($user['pseudo']); ?> </td>
                            <td> <?php 
                                if ($user['status']==1) {
                                ?>
                                    <a class="btn btn-success" href="index.php?page=valid_user&id=<?=$user['id']?>&v=<?=$user['status']?>"></a>
<?php
                                }
                            if ($user['status']==0) {
                                ?>
                                    <a class="btn btn-danger" href="index.php?page=valid_user&id=<?=$user['id']?>&v=<?=$user['status']?>"></a>
<?php
                            } ?>   </td>
                        </tr>
<?php

            } ?>
            </table><br/>

 

    <!--list of articles displaying their content, date, status validation-->
    <div class='container'>
            liste des articles pour validation<br/>
    <?php


            //création du tableau?>
            <table border=1>
                <tr>          
                    <th scope="col">Titre</th>
                    <th scope="col">Introduction</th>
                    <th scope="col">Contenu</th>
                    <th scope="col">date création</th>
                    <th scope="col">date modification</th>
                    <th scope="col">Validation</th>
                </tr>

<?php           foreach ($posts as $post) {
 
      //              $_SESSION['pseudo'] = $post['pseudo'];
       //             $_SESSION['email'] = $post['email']; ?>       
                        <tr>

                            <td> <?php echo ($post['title']); ?> </td>
                            <td> <?php echo ($post['introduction']); ?> </td>
                            <td> <?php echo ($post['content']); ?> </td>
                            <td> <?php echo ($post['createdAt']); ?> </td>
                            <td> <?php echo ($post['updateAt']); ?> </td>
                            <td> <?php echo ($post['postValid']);
                            echo ($post['postId']);
                            if ($post['postValid']==1) {
                                ?>
                                    <a class="btn btn-success" href="index.php?page=valid_post&id=<?=$post['postId']?>&v=<?=$post['status']?>"></a>
<?php
                            }
                            if ($post['postValid']==0) {
                                ?>
                                    <a class="btn btn-danger" href="index.php?page=valid_post&id=<?=($post['postId'])?>&v=<?=$post['status']?>"></a>
<?php
                            } ?>                                                          
                            </td>
<?php
                        } ?>
                        </tr>

            </table><br/>

    </div><br/>

<!--liste des commentaires affichant leur contenu, date, status validation-->
<div class='container'>
            liste des commentaires pour validation<br/>

            <table border=1>
                <tr>          
                    <th scope="col">Message</th>
                    <th scope="col">date création</th>
                    <th scope="col">date modification</th>
                    <th scope="col">Validation</th>
                </tr>

<?php           foreach ($comments as $comment) {

                    ?>       
                        <tr>

                            <td> <?php echo ($comment['contmessage']); ?> </td>
                            <td> <?php echo ($comment['createdAt']); ?> </td>
                            <td> <?php echo ($comment['updateAt']); ?> </td>
                            <td> <?php 
                                if ($comment['commentValid']==1) {
                                    ?>
                                    <a class="btn btn-success" href="index.php?page=valid_comment&id=<?=$comment['commentId'] ?>&v=<?=$comment['commentValid']?>"></a>
<?php
                                }
                            if ($comment['commentValid']==0) {
                                ?>
                                    <a class="btn btn-danger" href="index.php?page=valid_comment&id=<?=$comment['commentId']?>&v=<?=$comment['commentValid']?>"></a>
<?php
                            } ?>   </td>
<?php
                        } ?>
                        </tr>

            </table><br/>

    </div><br/>
<?php
$content = ob_get_clean();

require('../src/View/template/default.php');
