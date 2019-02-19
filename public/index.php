<?php
session_start();

require_once '../vendor/autoload.php';

use App\Controller\PostController;
use App\Controller\FormController;
use App\Controller\ConnectController;
use App\Controller\CommentController;
use App\Controller\AdminController;
use App\Model\Connect;

if (empty($_SESSION['status'])) {
    $_SESSION['status']=0;
}

if (empty($_SESSION['connect'])) {
    $_SESSION['connect']=0;
}

if (empty($_SESSION['pseudo'])) {
    $_SESSION['pseudo']=0;
}

if (empty($_SESSION['userId'])) {
    $_SESSION['userId']=0;
}

// Default opening : homeView.php
if (!empty($_GET['page'])) {
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
if ($p === 'postAdd'){
    if (!empty($_POST['title']) &&
        !empty($_POST['introduction']) &&
        !empty($_POST['content']) &&
        !empty($_POST['author'])) {

            $_SESSION['title'] = $_POST['title'] ;
            $_SESSION['introduction'] = $_POST['introduction'] ;
            $_SESSION['content'] = $_POST['content'] ;
            $_SESSION['author'] = $_POST['author'] ;

            $newPost = new PostController;
            $newPost->newPost();
            $newPost->listPosts();

            ?> 
                <script> alert("Votre article a bien été enregistré. Il est soumis à validation")</script>
            <?php
        }
    else{
        ?> 
            <script> alert("Merci de renseigner tous les champs")</script>
        <?php
    }
}

// edit post
if ($p === 'edit_post' &&
isset($_GET['id']) && !empty($_GET['id'])) {
    $_SESSION['postId']= intval($_GET['id']);
    $postController = new PostController();
    $postController->postEdit();
}

//update post
if ($p === 'postEdit' &&
isset($_POST['title']) && !empty($_POST['title']) &&
isset($_POST['introduction']) && !empty($_POST['introduction']) &&
isset($_POST['content']) && !empty($_POST['content']) &&
isset($_POST['author']) && !empty($_POST['author'])) {
    $_SESSION['title']= $_POST['title'];
    $_SESSION['introduction']= $_POST['introduction'];
    $_SESSION['content']= $_POST['content'];
    $_SESSION['author']= $_POST['author'];
    $postController = new PostController();
    $postController->postUpdate();
    $postController->post();
}

// delete post and his comments
if ($p === 'delete_post'){
    if (!empty($_GET['id'])){
        $_SESSION['postId']= intval($_GET['id']);
        $postController = new PostController();
        $postController->postDelete();
        $postController->listPosts();

        ?> 
            <script> alert("L'article a bien été supprimé")</script>
        <?php
    }

    else{
        ?> 
            <script> alert("l'article n'a pas été supprimé")</script>
        <?php
    }
}


//________________FORMS___________________
//send message
if ($p === 'formHome') {
    $formController = new FormController();
    $formController->sendMessage();
    require '../src/View/homeView.php';
}

// Identification
if ($p === 'formLogin' ) {
    if (empty($_POST['pseudo'])) {
        ?> 
            <script> alert("Merci de renseigner votre pseudonime")</script>
        <?php
        require '../src/View/registrationView.php';
    }

    if (empty($_POST['pass'])) {
        ?> 
            <script> alert("Merci de renseigner votre mot de passe")</script>
        <?php
            require '../src/View/registrationView.php';
    }

    if (!empty($_POST['pseudo']) && !empty($_POST['pass'])){
        //Data reception
        $_SESSION['pseudo']= htmlspecialchars($_POST['pseudo']);
        $_SESSION['pass'] = htmlspecialchars($_POST['pass']);

        //vérification du pseudo et du mot de passe et passage en mode connecté
        $verifPseudo= new ConnectController();
        $verifPseudo->Login();

        require '../src/View/homeView.php'; 

        ?> 
            <script> alert("Bienvenue")</script>
        <?php
    }

    else {
        echo 'Votre Pseudo ou mot de passe est incorrect';
    }
}

//Registration
if ($p === 'formAddUser' ){
    //messages according to the empty field
    if (empty($_POST['pseudo'])) {
        ?> 
            <script> alert("Merci de renseigner votre pseudonime")</script>
        <?php
            require '../src/View/registrationView.php';
    }

    if (empty($_POST['pass'])) {
        ?> 
            <script> alert("Merci de renseigner votre mot de passe")</script>
        <?php
            require '../src/View/registrationView.php';
    }

    if (empty($_POST['email'])) {
        ?> 
            <script> alert("Merci de renseigner votre e-mail")</script>
        <?php
            require '../src/View/registrationView.php';
    }

    if (empty($_POST['confPass'])) {
        ?> 
            <script> alert("Merci de confirmer votre email")</script>
        <?php
            require '../src/View/registrationView.php';
    }

    //Data reception
    $_SESSION['pseudo']= htmlspecialchars($_POST['pseudo']);
    $_SESSION['pass'] = htmlspecialchars($_POST['pass']);
    $_SESSION['email']= htmlspecialchars($_POST['email']);
    $_SESSION['confPass'] = htmlspecialchars($_POST['confPass']);

    //if both passwords are identical
    if ($_SESSION['pass'] === $_SESSION['confPass']) {

        //data processing
        $pass_hache= new ConnectController();
        $_SESSION['pass']=$pass_hache->hach();
        
    } else {
        ?> 
            <script> alert("Les mots de passe ne sont pas identiques")</script>
        <?php
            require '../src/View/registrationView.php';
    }

    // Verification of the free pseudo. If ok add new user
        $existPseudo= new ConnectController();
        $existPseudo->existPseudo();
       
        require '../src/View/homeView.php';
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
isset($_GET['id']) && !empty($_GET['id']) &&
isset($_GET['v']) && !empty($_GET['v'])) {
    $_SESSION['postId']= intval($_GET['id']);
    $_SESSION['postValid']= intval($_GET['v']);
    $adminController = new AdminController();
    $adminController->validPost();
    $adminController->displayUsers();
}

// valid comment
if ($p === 'valid_comment' &&
    !empty($_GET['id']) &&
    !empty($_GET['v'])) {

        $_SESSION['commentId']= intval($_GET['id']);
        $_SESSION['commentValid']= intval($_GET['v']);
        $adminController = new AdminController();
        $adminController->validComment();
        $adminController->displayUsers();
}

// valid user
if ($p === 'valid_user'){
    if (!empty($_GET['id']) && !empty($_GET['v'])){

        $_SESSION['userIdVal']= intval($_GET['id']);
        $_SESSION['statusVal']= intval($_GET['v']);
        $adminController = new AdminController();
        $adminController->validUser();
        $adminController->displayUsers();
    }

    else {
        $adminController = new AdminController();   
        $adminController->displayUsers();
    }
}


//________________COMMENTS________________
// Adding a comment
if ($p === 'commentAdd'){ 
    if (!empty($_POST['contmessage'])){

        $_SESSION['contmessage']=$_POST['contmessage'];
        $commentController = new CommentController();
        $commentController->commentAdd(); 
        
        ?>
            <script>alert('Merci de Votre commentaire. Il a été envoyé et va être soumis à validation')</script> 
        <?php
    
        $contArticle = new PostController();
        $contArticle->post();   
    }   
    else {
        $contArticle = new PostController();
        $contArticle->post();

        ?>
            <script>alert("Nous sommes désolée, votre commentaire n'a été envoyé.")</script> 
        <?php
    }
}

// reply comment
if ($p === 'reply_comment' &&
isset($_GET['id']) && !empty($_GET['id'])) {
    $_SESSION['parentId']= intval($_GET['id']);
    require '../src/View/replyCommentView.php';
}

// edit comment
if ($p === 'edit_comment' &&
isset($_GET['id']) && !empty($_GET['id']) &&
isset($_GET['contmessage']) && !empty($_GET['contmessage'])) {
    $_SESSION['commentId']= intval($_GET['id']);
    $_SESSION['contmessage']= $_POST['contmessage'];
    $commentController = new CommentController();
    $commentController->commentEdit();
}

//update comment
if ($p === 'commentEdit'&&
isset($_GET['contmessage']) && !empty($_GET['contmessage'])) {
    $_SESSION['contmessage']= $_POST['contmessage'];
    $commentController = new CommentController();
    $commentController->commentUpdate();

    $contArticle = new PostController();
    $contArticle->post();
}

// delete comment
if ($p === 'delete_comment'&&
isset($_GET['id']) && !empty($_GET['id'])) {
    $_SESSION['commentId']= intval($_GET['id']);
    $commentController = new CommentController();
    $commentController->commentDelete();

    $contArticle = new PostController();
    $contArticle->post();
}
