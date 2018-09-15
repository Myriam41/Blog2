<?php

namespace App\Repository;

use App\Model\Connect;
use App\Entity\User;

/**
 * Class UerRepository extend Connect
 */
class UserRepository extends Connect
{
    /**
     * @function SELECT all users
     * @return $users
     */
    public function getAllUsers()
    {
        $db = $this->getDb();

        $reqSelect = 'SELECT *';
        $reqFrom = ' FROM user';
        $reqWhere = ' ORDER BY createdAt DESC';
        $req = $db->prepare($reqSelect . $reqFrom . $reqWhere);
        $req->execute();
        $users = [];
        
        while ($data = $req->fetch()) {
            $users[] = $data;
        }

        $req->closeCursor();
        return $users;
    }

    /**
     * @function SELECT author with userId
     * @return $author
     */

    public function getAuthor()
    {
        $db = $this->getDb();

        $userId = $_GET['userId'];

        $reqSelect = 'SELECT *';
        $reqFrom = ' FROM post';
        $reqWhere = ' WHERE id = :userId';
        $req = $db->prepare($reqSelect . $reqFrom . $reqWhere);
        $req->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $req->execute();
        
        $data = $req->fetch();
        $author = new User($data);

        $req->closeCursor();
        return $author;
    }

    /**
     * function UPDATE valid user
     */
    public function updateValidUser()
    {
        $db = $this->getDb();

        if ($_SESSION['status']==1) {
            $reqUpdate = 'UPDATE user';
            $reqSet = ' SET status=0';
            $reqWhere = ' WHERE id=:id';
            $req = $db->prepare($reqUpdate . $reqSet . $reqWhere);
            $req->bindParam(':id', $_SESSION['userId'], \PDO::PARAM_INT);

            $req->execute();
        }

        if ($_SESSION['status']==0) {
            $reqUpdate = 'UPDATE user';
            $reqSet = ' SET status=1';
            $reqWhere = ' WHERE id=:id';
            $req = $db->prepare($reqUpdate . $reqSet . $reqWhere);
            $req->bindParam(':id', $_SESSION['userId'], \PDO::PARAM_INT);

            $req->execute();
        }
    }
}
