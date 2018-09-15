<?php

namespace App\Controller;

use App\Repository\CommentRepository;

/**
 * Class CommentController
 */
class CommentController
{
    /**
     * function delete comment
     */
    public function commentDelete()
    {
        $commentDelete = new CommentRepository();
        $commentDelete->DeleteComment();
    }

    /**
     * function edit comment
     */
    public function commentEdit()
    {
        $commentRepo = new CommentRepository();
        $comment = $commentRepo->getOneComment();
        require '../src/View/editCommentView.php';
    }

    /**
     * function post comment
     */
    public function commentsPost()
    {
        $dispComment = new CommentRepository();
        $comments = $dispComment->getCommentsPost();
    }

    /**
     * function add comment
     */
    public function commentAdd()
    {
        $commentAdd = new CommentRepository();
        $commentAdd->newComment();
    }

    /**
     * function update comment
     */
    public function commentUpdate()
    {
        $commentUpdate = new CommentRepository();
        $commentUpdate->UpdateComment();
    }
}
