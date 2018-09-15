<?php

namespace App\Repository;

use App\Model\Connect;
use App\Entity\Post;
use App\Entity\User;
use PDO;

/**
 * Class PostRepository extend Connect
 */

class PostRepository extends Connect
{
/**
 * function UPDATE valid post
 */
    public function updateValidPost()
    {
        $db = $this->getDb();

        if ($_SESSION['postValid']==1) {
            $reqUpdate = 'UPDATE post';
            $reqSet = ' SET valid=0';
            $reqWhere = ' WHERE id=:id';
            $req = $db->prepare($reqUpdate . $reqSet . $reqWhere);
            $req->bindParam(':id', $_SESSION['postId'], \PDO::PARAM_INT);

            $req->execute();

            $_SESSION['reqValid']='NO';
        }

        if ($_SESSION['postValid']==0) {
            $reqUpdate = 'UPDATE post';
            $reqSet = ' SET valid=1';
            $reqWhere = ' WHERE id=:id';
            $req = $db->prepare($reqUpdate . $reqSet . $reqWhere);
            $req->bindParam(':id', $_SESSION['postId'], \PDO::PARAM_INT);

            $req->execute();

            $_SESSION['reqValid']='OK';
        }
    }
    /**
     * @function SELECT the last 10 articles
     * @return $Posts array
     */
    public function getByLimit()
    {
        $db = $this->getDb();
    
        $reqSelect = 'SELECT p.id AS post_id, 
        p.title, p.introduction, p.createdAt, p.updateAt, user.pseudo';
        $reqFrom = ' FROM post AS p INNER JOIN user';
        $reqOn = ' ON p.userId = user.id';
        $reqWhere = ' WHERE p.valid = 1';
        $reqLimit = ' ORDER BY p.createdAt DESC LIMIT 0, 10';
        $req = $db->prepare($reqSelect . $reqFrom . $reqOn . $reqWhere . $reqLimit);
        $req->execute();
        $posts=[];

        while ($data = $req->fetch()) {
            $posts[]= $data;
        }

        $req->closeCursor();
        return $posts;
    }
    
    /**
     * @function SELECT a post with id
     * @param int $postId retreive one post
     * @return $post
     */
    public function getOneById()
    {
        $db = $this->getDb();

        $reqSelect = 'SELECT p.title, p.introduction, p.content, p.createdAt, p.updateAt, p.userId, p.id AS postId, u.pseudo  ';
        $reqFrom = ' FROM post AS p INNER JOIN user AS u';
        $reqOn = ' ON p.userId = u.id';
        $reqWhere = ' WHERE p.id = :postId AND p.valid = 1';
        $req = $db->prepare($reqSelect . $reqFrom . $reqOn . $reqWhere);
        $req->bindParam(':postId', $_SESSION['postId'], \PDO::PARAM_INT);
        $req->execute();
        $post=[];
        
        while ($data = $req->fetch()) {
            $post[] = $data;
        }
        $req->closeCursor();
        return $post;
    }

    /**
     * Function SELECT all posts
     * @return $posts
     */
    public function getAllPosts()
    {
        $db = $this->getDb();

        $reqSelect = 'SELECT p.title, p.introduction, p.content, p.createdAt, p.updateAt, p.valid AS postValid, p.userId, p.id AS postId, u.pseudo AS pseudo, u.email AS email';
        $reqFrom = ' FROM post AS p INNER JOIN user AS u';
        $reqOn = ' ON p.userId = u.id';
        $reqWhere = ' ORDER BY createdAt DESC';
        $req = $db->prepare($reqSelect . $reqFrom . $reqOn . $reqWhere);
        $req->execute();
        $posts =[];
        
        while ($data = $req->fetch()) {
            $posts[] = $data;
        }

        $req->closeCursor();
        return $posts;
    }

    /**
     * Function INSERT TO post
     */
    public function addPost()
    {
        $db = $this->getDb();

        $reqInsert = 'INSERT INTO post';
        $reqCol = '(title, introduction, content, createdAt, userId)';
        $reqValues = ' VALUES(:title, :introduction, :content, NOW() , :userId)';
        $req = $db->prepare($reqInsert . $reqCol . $reqValues);
        $req->bindParam(':title', $_SESSION['title'], \PDO::PARAM_STR);
        $req->bindParam(':introduction', $_SESSION['introduction'], \PDO::PARAM_STR);
        $req->bindParam(':content', $_SESSION['content'], \PDO::PARAM_STR);
        $req->bindParam(':userId', $_SESSION['userId'], \PDO::PARAM_INT);

        $req->execute();
    }

    /**
     * Function DELETE post
     */
    public function deletePost()
    {
        $db = $this->getDb();

        $reqUpdate = 'DELETE FROM post';
        $reqWhere = ' WHERE id=:id';
        $req = $db->prepare($reqUpdate . $reqWhere);
        $req->bindParam(':id', $_SESSION['postId'], \PDO::PARAM_INT);

        $req->execute();
    }

    /**
     * function UPDATE one post
     */
    public function updatePost()
    {
        $db = $this->getDb();

        $reqUpdate = 'UPDATE post';
        $reqSet = ' SET title=:title, introduction=:introduction, content=:content, updateAt=now()';
        $reqWhere = ' WHERE id=:id';
        $req = $db->prepare($reqUpdate . $reqSet . $reqWhere);
        $req->bindParam(':id', $_SESSION['postId'], \PDO::PARAM_INT);
        $req->bindParam(':title', $_SESSION['title'], \PDO::PARAM_STR);
        $req->bindParam(':introduction', $_SESSION['introduction'], \PDO::PARAM_STR);
        $req->bindParam(':content', $_SESSION['content'], \PDO::PARAM_STR);

        $req->execute();
    }
}
