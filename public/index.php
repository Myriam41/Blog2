<?php
session_start();

require_once '../vendor/autoload.php';

use App\Controller\PostController;
use App\Controller\FormController;
use App\Controller\ConnectController;
use App\Controller\CommentController;
use App\Controller\AdminController;
use App\Model\Connect;

if (!isset($_SESSION['status'])) {
    $_SESSION['status']=0;
}

if (!isset($_SESSION['connect'])) {
    $_SESSION['connect']=0;
}

if (!isset($_SESSION['pseudo'])) {
    $_SESSION['pseudo']=0;
}

if (!isset($_SESSION['userId'])) {
    $_SESSION['userId']=0;
}

// Default opening : homeView.php
if (isset($_GET['page'])) {
    $p = $_GET['page'];
} else {
    $p = 'home';
}

// Routes
// Home
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
if ($p === 'postAdd') {
    $_SESSION['title'] = htmlspecialchars($_POST['title'], ENT_IGNORE);
    $_SESSION['introduction'] = htmlspecialchars($_POST['introduction'], ENT_IGNORE);
    $_SESSION['content'] = htmlspecialchars($_POST['content'], ENT_IGNORE);

    $newPost = new PostController;
    $newPost->newPost();
    $newPost->listPosts();
}
// edit post
if ($p === 'edit_post') {
    $_SESSION['postId']= intval($_GET['id']);
    $postController = new PostController();
    $postController->postEdit();
}

//update post
if ($p === 'postEdit') {
    $_SESSION['title']= ($_POST['title']); //ne fonctionne pas avec htmlspecialchars
    $_SESSION['introduction']= htmlspecialchars($_POST['introduction'], ENT_IGNORE);
    $_SESSION['content']= htmlspecialchars($_POST['content'], ENT_IGNORE);
    $postController = new PostController();
    $postController->postUpdate();
    $postController->post();
}

// delete post éliminer les commentaires liés
if ($p === 'delete_post') {
    $_SESSION['postId']= intval($_GET['id']);
    $postController = new PostController();
    $postController->postDelete();
    $postController->listPosts();
}

//________________CONTACT_________________
//contact
if ($p === 'contact') {
    require '../src/View/contactView.php';
}

//________________FORMS___________________
//send message
if ($p === 'formHome') {
    $formController = new FormController();
    $formController->sendMessage();
    require '../src/View/homeView.php';
}

// Identification
if ($p === 'formLogin') {
    //Data reception
    $_SESSION['pseudo']= htmlspecialchars($_POST['pseudo']);
    $_SESSION['pass'] = htmlspecialchars($_POST['pass']);
  
    //Vérifier qu'aucun champs est vide
    if (!$_SESSION['pseudo']) {
        ?> <script> alert("Merci de renseigner votre pseudonime")</script>
    <?php
    }
  
    if (!$_SESSION['pass']) {
        ?> <script> alert("Merci de renseigner votre mot de passe")</script>
    <?php
    }

    //vérification du pseudo et du mot de passe et passage en mode connecté
    $verifPseudo= new ConnectController();
    $verifPseudo->Login();
    require '../src/View/homeView.php';
}

//Registration
if ($p === 'formAddUser') {
    //Data reception
    $_SESSION['pseudo']= htmlspecialchars($_POST['pseudo']);
    $_SESSION['pass'] = htmlspecialchars($_POST['pass']);
    $_SESSION['email']= htmlspecialchars($_POST['email']);
    $_SESSION['confPass'] = htmlspecialchars($_POST['confPass']);

    //Vérifier qu'aucun champs est vide
    if (!$_SESSION['pseudo']) {
        ?> <script> alert("Merci de renseigner votre pseudonime")</script>
  <?php
    }

    if (!$_SESSION['pass']) {
        ?> <script> alert("Merci de renseigner votre mot de passe")</script>
  <?php
    }

    if (!$_SESSION['email']) {
        ?> <script> alert("Merci de renseigner votre e-mail")</script>
  <?php
    }

    if (!$_SESSION['confPass']) {
        ?> <script> alert("Merci de confirmer votre mot de passe")</script>
  <?php
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
if ($p === 'valid_post') {
    $_SESSION['postId']= intval($_GET['id']);
    $_SESSION['postValid']= intval($_GET['v']);
    $adminController = new AdminController();
    $adminController->validPost();
    $adminController->displayUsers();
}

// valid comment
if ($p === 'valid_comment') {
    $_SESSION['commentId']= intval($_GET['id']);
    $_SESSION['commentValid']= intval($_GET['v']);
    $adminController = new AdminController();
    $adminController->validComment();
    $adminController->displayUsers();
}

// valid user
if ($p === 'valid_user') {
    $_SESSION['userId']= intval($_GET['id']);
    $_SESSION['status']= intval($_GET['v']);
    $adminController = new AdminController();
    $adminController->validUser();
    $adminController->displayUsers();
}


//________________COMMENTS________________
// Adding a comment
if ($p === 'commentAdd') {
    $_SESSION['contmessage']=$_POST['contmessage'];
    $commentController = new CommentController();
    $commentController->commentAdd();

    $contArticle = new PostController();
    $contArticle->post();
}

// reply comment
if ($p === 'reply_comment') {
    $_SESSION['parentId']= intval($_GET['id']);
    require '../src/View/replyCommentView.php';
}

// edit comment
if ($p === 'edit_comment') {
    $_SESSION['commentId']= intval($_GET['id']);
    $_SESSION['contmessage']= ($_POST['contmessage']);
    $commentController = new CommentController();
    $commentController->commentEdit();

    //commment écrire directement sur la page ? AJAX
}

//update comment
if ($p === 'commentEdit') {
    $_SESSION['contmessage']= htmlspecialchars($_POST['contmessage'], ENT_IGNORE);
    $commentController = new CommentController();
    $commentController->commentUpdate();

    $contArticle = new PostController();
    $contArticle->post();
}

// delete comment
if ($p === 'delete_comment') {
    $_SESSION['commentId']= intval($_GET['id']);
    $commentController = new CommentController();
    $commentController->commentDelete();

    $contArticle = new PostController();
    $contArticle->post();
}

//________________Replies________________

//display replies
//non utilisé pour l'instant essais en cours
if ($p==='replies') {
    $replyComment = new CommentRepository();
    $replies = $replyComment->getReplies();
    return $replies;
}


// penser un envoyer un message pour vérifier que l'email est valide

//super comment