<?php

namespace App\Repository;

use App\Model\Connect;
use App\Entity\Comment;

/**
 * class CommentRepository extends Connect
 */
class CommentRepository extends Connect
{
    /**
     * function DELETE comment
     */
    public function deleteComment()
    {
        $db = $this->getDb();

        $reqUpdate = 'DELETE FROM comments';
        $reqWhere = ' WHERE id=:id';
        $req = $db->prepare($reqUpdate . $reqWhere);
        $req->bindParam(':id', $_SESSION['commentId'], \PDO::PARAM_INT);

        $req->execute();
    }

    /**
     * function SELECT one comment
     * @return $comment
     */
    public function getOneComment()
    {
        $db = $this->getDb();
    
        $reqSelect = 'SELECT *';
        $reqFrom = ' FROM comments';
        $reqWhere = ' WHERE id = :commentId';
        $req = $db->prepare($reqSelect . $reqFrom . $reqWhere);
        $req->bindparam(':commentId', $_SESSION['commentId'], \PDO::PARAM_INT);
        $req->execute();
        
        $comment = [];
        while ($data = $req->fetch()) {
            $comment[] = $data;
        }
        $req->closeCursor();
        return $comment;

        $this->getReplies();
    }

    /**
     * function SELECT comments of one post
     * @return $comments array
     */
    public function getCommentsPost($articleId)
    {
        $db = $this->getDb();
    
        // récupération des comments d'un article
        $reqSelect = 'SELECT c.id AS comment_id, 
        c.contmessage, c.createdAt, c.updateAt, u.pseudo AS pseudo';
        $reqFrom = ' FROM comments AS c';
        $reqOn = ' INNER JOIN post ON c.postId = post.id
        INNER JOIN user AS u ON c.userId = u.id';
        $reqWhere = ' WHERE postId = :articleId AND parentId = 0 AND c.valid=1';
        $reqOrder = ' ORDER BY c.createdAt DESC';
        $req = $db->prepare($reqSelect . $reqFrom . $reqOn . $reqWhere . $reqOrder);
        $req->bindparam(':articleId', $_SESSION['postId'], \PDO::PARAM_INT);
        $req->execute();
        
        $comments = [];
        while ($data = $req->fetch()) {
            $comments[] = $data;
        }
        $req->closeCursor();
        return $comments;

        $this->getReplies();
    }

    /**
     * function SELECT replies of comments one post
     * @return $replies array
     */
    public function getReplies()
    {
        $db = $this->getDb();
    
        // récupération des réponses à un commentaire
        $reqSelect = 'SELECT c.id AS comment_id, 
        c.contmessage, c.createdAt, c.updateAt, c.parentId, u.pseudo';
        $reqFrom = ' FROM comments AS c';
        $reqOn = ' INNER JOIN user AS u ON c.userId = u.id';
        $reqWhere = ' WHERE c.postId = :articleId AND valid=1';
        $reqOrder = ' ORDER BY c.createdAt DESC';
        $req = $db->prepare($reqSelect . $reqFrom . $reqOn . $reqWhere . $reqOrder);
        $req->bindparam(':articleId', $_SESSION['postId'], \PDO::PARAM_INT);
        $req->execute();
        
        $replies = [];
        while ($data = $req->fetch()) {
            $replies[] = $data;
        }
        $req->closeCursor();
        return $replies;
    }
    
    /**
     * function SELECT alls comments
     * @return $comments
     */
    public function getAllComments()
    {
        $db = $this->getDb();
    
        // DIsplay all comments
        $reqSelect = 'SELECT c.id AS commentId, 
        c.contmessage, c.createdAt, c.updateAt, c.parentId, c.valid AS commentValid, u.pseudo AS pseudo, u.email AS email';
        $reqFrom = ' FROM comments AS c';
        $reqOn = ' INNER JOIN user AS u ON c.userId = u.id';
        $reqOrder = ' ORDER BY c.createdAt DESC';
        $req = $db->prepare($reqSelect . $reqFrom . $reqOn . $reqOrder);
        $req->bindparam(':articleId', $_SESSION['commentId'], \PDO::PARAM_INT);
        $req->execute();
        $comments = [];

        while ($data = $req->fetch()) {
            $comments[] = $data;
        }
    
        return $comments;
    }

    /**
     * Function INSERT TO comments
     */
    public function newComment()
    {
        $db = $this->getDb();
        if (!isset($_SESSION['parentId'])) {
            $_SESSION['parentId']=0;
        }

        $reqInsert = 'INSERT INTO comments';
        $reqCol = '(postId, contmessage, createdAt, userId, parentId)';
        $reqValues = ' VALUES(:postId, :contmessage, NOW() , :userId, :parentId)';
        $req = $db->prepare($reqInsert . $reqCol . $reqValues);
        $req->bindParam(':postId', $_SESSION['postId'], \PDO::PARAM_STR);
        $req->bindParam(':contmessage', $_SESSION['contmessage'], \PDO::PARAM_STR);
        $req->bindParam(':userId', $_SESSION['userId'], \PDO::PARAM_INT);
        $req->bindParam(':parentId', $_SESSION['parentId'], \PDO::PARAM_INT);

        $req->execute();
    }

    /**
     * function UPDATE comment
     */
    public function updateComment()
    {
        $db = $this->getDb();

        $reqUpdate = 'UPDATE comments';
        $reqSet = ' SET contmessage=:contmessage, updateAt=now()';
        $reqWhere = ' WHERE id=:id';
        $req = $db->prepare($reqUpdate . $reqSet . $reqWhere);
        $req->bindParam(':id', $_SESSION['commentId'], \PDO::PARAM_INT);
        $req->bindParam(':contmessage', $_SESSION['contmessage'], \PDO::PARAM_STR);

        $req->execute();
    }

    /**
     * function UPDATE valid comment
     */
    public function updateValidComment()
    {
        $db = $this->getDb();

        if ($_SESSION['commentValid']==1) {
            $reqUpdate = 'UPDATE comments';
            $reqSet = ' SET valid=0';
            $reqWhere = ' WHERE id=:id';
            $req = $db->prepare($reqUpdate . $reqSet . $reqWhere);
            $req->bindParam(':id', $_SESSION['commentId'], \PDO::PARAM_INT);

            $req->execute();
        }

        if ($_SESSION['commentValid']==0) {
            $reqUpdate = 'UPDATE comments';
            $reqSet = ' SET valid=1';
            $reqWhere = ' WHERE id=:id';
            $req = $db->prepare($reqUpdate . $reqSet . $reqWhere);
            $req->bindParam(':id', $_SESSION['commentId'], \PDO::PARAM_INT);

            $req->execute();
        }
    }
}
