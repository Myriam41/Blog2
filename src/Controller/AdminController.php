<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Entity\User;

/**
 * Class UserController
 */
class AdminController
{
    //________________valid_____________________
    /**
     * function valid user
     */
    public function validUser()
    {
        $userRepo = new userRepository();
        $valid = $userRepo->updateValidUser();
    }

    /**
     * function valid comment
     */
    public function validComment()
    {
        $commentRepo = new commentRepository();
        $valid = $commentRepo->updateValidComment();
    }

    /**
     * function valid post
     */
    public function validPost()
    {
        $postRepo = new postRepository();
        $valid = $postRepo->updateValidPost();
        if ($_SESSION['reqValid']='OK') {
            $to = $_SESSION['email'];
            $subject = 'Votre article sur VivaInformatique';
            $message = $_SESSION['pseudo'] . ' , votre article est validé.' . "\r\n" . 'il est désormais visible sur le site VivaInformatique';
           
            // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
            $headers = 'MIME-Version: 1.0';
            $headers .= 'Content-type: text/html; charset=iso-8859-1';

            // En-têtes additionnels
            $headers .= 'To:' . $_SESSION['pseudo'] . $_SESSION['email'];
            $headers .= 'From: VivaInformatique <lieninformatique9@gmail.com>';
            //   mail($to, $subject, $message, $headers);
        }

        if ($_SESSION['reqValid']='NO') {
            $to = $_SESSION['email'];
            $subject = 'Votre article sur VivaInformatique';
            $message = $_SESSION['pseudo'] . ' , votre article a été refusé.' . "\r\n" . 'pour plus de détail n\'hésitez pas à nous contacter';
           
            // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
            $headers = 'MIME-Version: 1.0';
            $headers .= 'Content-type: text/html; charset=iso-8859-1';

            // En-têtes additionnels
            $headers .= 'To:' . $_SESSION['pseudo'] . $_SESSION['email'];
            $headers .= 'From: VivaInformatique <lieninformatique9@gmail.com>';
            //   mail($to, $subject, $message, $headers);
        }
    }

    //________________display_____________________
    /**
     * function display all users
     */
    public function displayUsers()
    {
        $userRepo= new UserRepository();
        $postRepo=new PostRepository();
        $commentRepo= new CommentRepository();

        $users = $userRepo->getAllUsers();
        $posts = $postRepo->getAllPosts();
        $comments = $commentRepo->getAllComments();
        require '../src/View/administrationView.php';
    }

    /**
     * function display all posts
     */
    public function displayPosts()
    {
        $postRepo= new PostRepository();
        $posts=$postRepo->getAllPosts();
        require '../src/View/administrationView.php';
    }
}
