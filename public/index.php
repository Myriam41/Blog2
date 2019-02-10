<?php
session_start();

require_once '../vendor/autoload.php';

use App\Controller\PostController;
use App\Controller\FormController;
use App\Controller\ConnectController;
use App\Controller\CommentController;
use App\Controller\AdminController;
use App\Model\Connect;

if (!isset($_SESSION['status']) && empty($_SESSION['status'])) {
    $_SESSION['status']=0;
}

if (!isset($_SESSION['connect']) && empty($_SESSION['connect'])) {
    $_SESSION['connect']=0;
}

if (!isset($_SESSION['pseudo']) && empty($_SESSION['pseudo'])) {
    $_SESSION['pseudo']=0;
}

if (!isset($_SESSION['userId']) && empty($_SESSION['userId'])) {
    $_SESSION['userId']=0;
}

// Default opening : homeView.php
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $p = $_GET['page'] ;
} else {
    $p = 'home';
}

// Routes
// ______________HOME__________________
if ($p === 'home') {
    require '../src/View/homeView.php';
}

//_______________POSTS__________________
// List of posts
if ($p === 'postList') {
    $postController = new PostController();
    $postController->listPosts();
}

// One post
if ($p === 'post') {
    $_SESSION['postId'] = $_GET['id'];
    $contArticle = new PostController();
    $contArticle->post();
}

// Display postAddView
if ($p === 'postNew') {
    require '../src/View/postAddView.php';
}

// Add Post
if ($p === 'postAdd' &&
isset($_POST['title']) && empty($_POST['title']) &&
isset($_POST['introduction']) && empty($_POST['introduction']) &&
isset($_POST['content']) && empty($_POST['content']) &&
isset($_POST['author']) && empty($_POST['author'])) {
    $_SESSION['title'] = esc_html($_POST['title'], ENT_IGNORE);
    $_SESSION['introduction'] = esc_html($_POST['introduction'], ENT_IGNORE);
    $_SESSION['content'] = esc_html($_POST['content'], ENT_IGNORE);
    $_SESSION['author'] = esc_html($_POST['author'], ENT_IGNORE);

    $newPost = new PostController;
    $newPost->newPost();
    $newPost->listPosts();
}

// edit post
if ($p === 'edit_post' &&
isset($_GET['id']) && !isEmpty($_GET['id'])) {
    $_SESSION['postId']= intval($_GET['id']);
    $postController = new PostController();
    $postController->postEdit();
}

//update post
if ($p === 'postEdit' &&
isset($_POST['title']) && !isEmpty($_POST['title']) &&
isset($_POST['introduction']) && !isEmpty($_POST['introduction']) &&
isset($_POST['content']) && !isEmpty($_POST['content']) &&
isset($_POST['author']) && !isEmpty($_POST['author'])) {
    $_SESSION['title']= esc_html($_POST['title']);
    $_SESSION['introduction']= esc_html($_POST['introduction'], ENT_IGNORE);
    $_SESSION['content']= esc_html($_POST['content'], ENT_IGNORE);
    $_SESSION['author']= esc_html($_POST['author'], ENT_IGNORE);
    $postController = new PostController();
    $postController->postUpdate();
    $postController->post();
}

// delete post and his comments
if ($p === 'delete_post' &&
isset($_GET['id']) && !isEmpty($_GET['id'])) {
    $_SESSION['postId']= intval($_GET['id']);
    $postController = new PostController();
    $postController->postDelete();
    $postController->listPosts();
}

//________________FORMS___________________
//send message
if ($p === 'formHome') {
    $formController = new FormController();
    $formController->sendMessage();
    require '../src/View/homeView.php';
}

// Identification
if ($p === 'formLogin' &&
isset($_POST['pseudo']) && !isEmpty($_POST['pseudo']) &&
isset($_POST['pass']) && !isEmpty($_POST['passs'])) {
    //Data reception
    $_SESSION['pseudo']= htmlspecialchars($_POST['pseudo']);
    $_SESSION['pass'] = htmlspecialchars($_POST['pass']);
  
    //Vérifier qu'aucun champs est vide
    if (!$_SESSION['pseudo']) {
        ?>
        <script> alert("Merci de renseigner votre pseudonime")</script>
    <?php
        require '../src/View/registrationView.php';
    }
  
    if (!empty($_SESSION['pseudo']) and !$_SESSION['pass']) {
        ?> 
        <script> alert("Merci de renseigner votre mot de passe")</script>
    <?php
        require '../src/View/registrationView.php';
    }
    if (!empty($_SESSION['pseudo']) and !empty($_SESSION['pass'])) {
        //vérification du pseudo et du mot de passe et passage en mode connecté
        $verifPseudo= new ConnectController();
        $verifPseudo->Login();
        require '../src/View/homeView.php'; ?> 
        <script> alert("Bienvenue")</script>
    <?php
    }
}

//Registration
if ($p === 'formAddUser' &&
isset($_POST['pseudo']) && !isEmpty($_POST['pseudo']) &&
isset($_POST['pass']) && !isEmpty($_POST['passs']) &&
isset($_POST['email']) && !isEmpty($_POST['email']) &&
isset($_POST['confpass']) && !isEmpty($_POST['confpass'])) {
    //Data reception
    $_SESSION['pseudo']= esc_html($_POST['pseudo']);
    $_SESSION['pass'] = esc_html($_POST['pass']);
    $_SESSION['email']= esc_html($_POST['email']);
    $_SESSION['confPass'] = esc_html($_POST['confPass']);

    //Vérifier qu'aucun champs est vide
    if (!$_SESSION['pseudo']) {
        ?> 
        <script> alert("Merci de renseigner votre pseudonime")</script>
    <?php
        require '../src/View/registrationView.php';
    }

    if (!$_SESSION['pass']) {
        ?> <script> alert("Merci de renseigner votre mot de passe")</script>
    <?php
        require '../src/View/registrationView.php';
    }

    if (!$_SESSION['email']) {
        ?> <script> alert("Merci de renseigner votre e-mail")</script>
    <?php
        require '../src/View/registrationView.php';
    }

    if (!$_SESSION['confPass']) {
        ?> <script> alert("Merci de confirmer votre mot de passe")</script>
    <?php
        require '../src/View/registrationView.php';
    }

    //si les mots de passes sont identiques
    if ($_SESSION['pass'] === $_SESSION['confPass']) {
        //data processing
        $pass_hache= new ConnectController();
        $_SESSION['pass']=$pass_hache->hach();

        // Verification of the free pseudo. If ok add new user
        $existPseudo= new ConnectController();
        $existPseudo->existPseudo();

        require '../src/View/homeView.php';
    } else {
        echo 'Les deux mots de passes sont différents';
    }
}

//________________LOG AND STATUS___________________
// Identification
if ($p === 'login') {
    if ($_SESSION['connect'] === 1) {
        session_destroy();
        $_SESSION['connect'] = 0;
        require '../src/View/homeView.php'; ?> <script>alert('Vous êtes déconnecté')</script> <?php
    } else {
        require '../src/View/registrationView.php';
    }
}

//_______________ADMIN__________________
// display admin gestion
if ($p === 'admin') {
    $adminController = new AdminController();
    $adminController->displayUsers();
}

// valid article
if ($p === 'valid_post' &&
isset($_GET['id']) && !isEmpty($_GET['id']) &&
isset($_GET['v']) && !isEmpty($_GET['v'])) {
    $_SESSION['postId']= intval($_GET['id']);
    $_SESSION['postValid']= intval($_GET['v']);
    $adminController = new AdminController();
    $adminController->validPost();
    $adminController->displayUsers();
}

// valid comment
if ($p === 'valid_comment' &&
isset($_GET['id']) && !isEmpty($_GET['id']) &&
isset($_GET['v']) && !isEmpty($_GET['v'])) {
    $_SESSION['commentId']= intval($_GET['id']);
    $_SESSION['commentValid']= intval($_GET['v']);
    $adminController = new AdminController();
    $adminController->validComment();
    $adminController->displayUsers();
}

// valid user
if ($p === 'valid_user' &&
isset($_GET['id']) && !isEmpty($_GET['id']) &&
isset($_GET['v']) && !isEmpty($_GET['v'])) {
    $_SESSION['userId']= intval($_GET['id']);
    $_SESSION['status']= intval($_GET['v']);
    $adminController = new AdminController();
    $adminController->validUser();
    $adminController->displayUsers();
}

//________________COMMENTS________________
// Adding a comment
if ($p === 'commentAdd' &&
isset($_GET['contmessage']) && !isEmpty($_GET['contmessage'])){
    $_SESSION['contmessage']=$_POST['contmessage'];
    $commentController = new CommentController();
    $commentController->commentAdd(); ?><script>alert('Votre commentaire a été envoyé pour être soumis à validation')</script> <?php


    $contArticle = new PostController();
    $contArticle->post();
}

// reply comment
if ($p === 'reply_comment' &&
isset($_GET['id']) && !isEmpty($_GET['id'])) {
    $_SESSION['parentId']= intval($_GET['id']);
    require '../src/View/replyCommentView.php';
}

// edit comment
if ($p === 'edit_comment' &&
isset($_GET['id']) && !isEmpty($_GET['id']) &&
isset($_GET['contmessage']) && !isEmpty($_GET['contmessage'])) {
    $_SESSION['commentId']= intval($_GET['id']);
    $_SESSION['contmessage']= esc_html($_POST['contmessage']);
    $commentController = new CommentController();
    $commentController->commentEdit();
}

//update comment
if ($p === 'commentEdit'&&
isset($_GET['contmessage']) && !isEmpty($_GET['contmessage'])) {
    $_SESSION['contmessage']= esc_html($_POST['contmessage'], ENT_IGNORE);
    $commentController = new CommentController();
    $commentController->commentUpdate();

    $contArticle = new PostController();
    $contArticle->post();
}

// delete comment
if ($p === 'delete_comment'&&
isset($_GET['id']) && !isEmpty($_GET['id'])) {
    $_SESSION['commentId']= intval($_GET['id']);
    $commentController = new CommentController();
    $commentController->commentDelete();

    $contArticle = new PostController();
    $contArticle->post();
}
