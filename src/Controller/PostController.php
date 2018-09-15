<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\Commentrepository;
use App\Entity\User;

/**
 * Class PostController
 */
class PostController
{
    /**
     * Get the last 10 posts
     * @var $posts
     */
    public function listPosts()
    {
        $postRepository = new PostRepository();
        $posts = $postRepository->getByLimit();
        require '../src/View/postListView.php';
    }
    
    /**
     * Get one article with comments
     * @var $article and contents
     */
    public function post()
    {
        $postRepository = new PostRepository();
        $dispComment = new CommentRepository();
        $replyComment = new CommentRepository();

        if (!empty($_SESSION['postId'])) {
            $post = $postRepository->getOneById($_SESSION['postId']);
            $comments = $dispComment->getCommentsPost($_SESSION['postId']);
            $replies = $replyComment->getReplies($_SESSION['postId']);
        }

        require '../src/View/postView.php';
    }

    /**
     * Get author of a post
     * @var $author
     */
    public function author()
    {
        $userId = $_post['userId'];
        $userRepository = new UserRepository();
        if (!empty($userId)) {
            $author = $userRepository->getAuthor();
        }
    }

    /**
     * new post
     */
    public function newPost()
    {
        $addPost = new PostRepository();
        $addPost->addPost();
    }

    /**
     * edit post
     */
    public function postEdit()
    {
        $postRepo = new PostRepository();
        $post = $postRepo->getOneById();
        require '../src/View/editPostView.php';
    }

    /**
     * delete post
     */
    public function postDelete()
    {
        $postDelete = new PostRepository();
        $postDelete->deletePost();
    }

    /**
     * update post
     */
    public function postUpdate()
    {
        $postUpdate = new PostRepository();
        $postUpdate->updatePost();
    }
}
