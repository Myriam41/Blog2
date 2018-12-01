<?php

$imgHeader = esc_html('');
$pageTitle = esc_html('');
$subTitle = esc_html('Coin administration');

// Page header little image
$imglittle = esc_html('');

ob_start();?> 
    <div class='container'>
    <!--liste des utilisateurs affichant leur nom, ey statut et date enregistrement-->
        liste des utilisateurs pour l'attribution des status<br/>
    <?php
        //création d'un tableau pour gérer les utilisateurs
        $nbCol = 2;
        $array = array('pseudo', 'status');
        $nbData = sizeof($array);

        //calcul du nombre de ligne
        if (round($nbData/$nbCol) != ($nbData/$nbCol)) {
            $nbLigne = round(($nbreData/$nbCol)+0.5);
        } else {
            $nbLigne = $nbData/$nbCol;
        }

        //Affichage
        if ($nbLigne != 0) {
            //initialisation de la lecture du tableau
            $k = 0;
            //création du tableau?>
            <table border ="1">
                <tr>          
                    <th scope="col">Utilisateur</th>
                    <th scope="col">Statut</th>
                </tr>

<?php           foreach ($users as $user) {
                for ($i=1; $i<=$nbLigne; $i++) {
                    ?>       
                        <tr>
<?php 
                        if ($k < $nbData) {
                            ?>
                            <td> <?php echo esc_attr($user['pseudo']); ?> </td>
                            <td> <?php 
                                if ($user['status']==1) {
                                    ?>
                                    <a class="btn btn-success" href="index.php?page=valid_user&id=<?= esc_url($user['id']) ?>&v=<?= esc_url($user)['status']?>"></a>
<?php
                                }
                            if ($user['status']==0) {
                                ?>
                                    <a class="btn btn-danger" href="index.php?page=valid_user&id=<?= esc_url($user['id']) ?>&v=<?= esc_url($user['status'])?>"></a>
<?php
                            } ?>   </td>
<?php
                        } ?>
                        </tr>
<?php
                }
            } ?>
            </table><br/>
<?php
        } ?>

    <!--liste des articles affichant leur contenu, date, status validation-->
    <div class='container'>
            liste des articles pour validation<br/>
    <?php
        //création d'un tableau pour gérer les utilisateurs
        $nbCol2 = 6;
        $array2 = array('title', 'introduction', 'content', 'createdAt', 'updateAt', 'validation');
        $nbData2 = sizeof($array2);

        //calcul du nombre de ligne
        if (round($nbData2/$nbCol2) != ($nbData2/$nbCol2)) {
            $nbLigne = round(($nbreData2/$nbCol2)+0.5);
        } else {
            $nbLigne = $nbData2/$nbCol2;
        }

        //Affichage
        if ($nbLigne != 0) {
            //initialisation de la lecture du tableau
            $k = 0;
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
                for ($i=1; $i<=$nbLigne; $i++) {
                    $_SESSION['pseudo'] = esc_attr($post['pseudo']);
                    $_SESSION['email'] = esc_attr($post['email']); ?>       
                        <tr>
<?php 
                        if ($k < $nbData2) {
                            ?>
                            <td> <?php echo esc_attr($post['title']); ?> </td>
                            <td> <?php echo esc_attr($post['introduction']); ?> </td>
                            <td> <?php echo esc_attr($post['content']); ?> </td>
                            <td> <?php echo esc_attr($post['createdAt']); ?> </td>
                            <td> <?php echo esc_attr($post['updateAt']); ?> </td>
                            <td> <?php echo esc_attr($post['postValid']);
                            echo esc_attr($post['postId']);
                            if ($post['postValid']==1) {
                                ?>
                                    <a class="btn btn-success" href="index.php?page=valid_post&id=<?= esc_url($post['postId']) ?>&v=<?= esc_url($post['postValid'])?>"></a>
<?php
                            }
                            if ($post['postValid']==0) {
                                ?>
                                    <a class="btn btn-danger" href="index.php?page=valid_post&id=<?= esc_url($post['postId']) ?>&v=<?= esc_url($post['postValid'])?>"></a>
<?php
                            } ?>                                                          
                            </td>
<?php
                        } ?>
                        </tr>
<?php
                }
            } ?>
            </table><br/>
<?php
        } ?>
    </div><br/>

<!--liste des commentaires affichant leur contenu, date, status validation-->
<div class='container'>
            liste des commentaires pour validation<br/>
    <?php
        //création d'un tableau pour gérer les utilisateurs
        $nbCol3 = 4;
        $array3 = array('contmessage', 'createdAt', 'updateAt', 'valid');
        $nbData3 = sizeof($array3);

        //calcul du nombre de ligne
        if (round($nbData3/$nbCol3) != ($nbData3/$nbCol3)) {
            $nbLigne = round(($nbreData2/$nbCol3)+0.5);
        } else {
            $nbLigne = $nbData3/$nbCol3;
        }

        //Affichage
        if ($nbLigne != 0) {
            //initialisation de la lecture du tableau
            $k = 0;
            //création du tableau?>
            <table border=1>
                <tr>          
                    <th scope="col">Message</th>
                    <th scope="col">date création</th>
                    <th scope="col">date modification</th>
                    <th scope="col">Validation</th>
                </tr>

<?php           foreach ($comments as $comment) {
                for ($i=1; $i<=$nbLigne; $i++) {
                    ?>       
                        <tr>
<?php 
                        if ($k < $nbData3) {
                            ?>
                            <td> <?php echo esc_attr($comment['contmessage']); ?> </td>
                            <td> <?php echo esc_attr($comment['createdAt']); ?> </td>
                            <td> <?php echo esc_attr($comment['updateAt']); ?> </td>
                            <td> <?php 
                                if ($comment['commentValid']==1) {
                                    ?>
                                    <a class="btn btn-success" href="index.php?page=valid_comment&id=<?= esc_url($comment['commentId']) ?>&v=<?= esc_url($comment['commentValid'])?>"></a>
<?php
                                }
                            if ($comment['commentValid']==0) {
                                ?>
                                    <a class="btn btn-danger" href="index.php?page=valid_comment&id=<?= esc_url($comment['commentId']) ?>&v=<?= esc_url($comment['commentValid'])?>"></a>
<?php
                            } ?>   </td>
<?php
                        } ?>
                        </tr>
<?php
                }
            } ?>
            </table><br/>
<?php
        } ?>
    </div><br/>

    <!--Liste des statuts.-->
        <div class='row'>
            liste des status pour création éventuellement
        </div>
    </div>
<?php
$content = ob_get_clean();

require('../src/View/template/default.php');
