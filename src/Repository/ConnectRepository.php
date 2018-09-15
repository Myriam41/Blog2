<?php

namespace App\Repository;

use App\Model\Connect;

/**
 * Class ConnectRepository extend connect
 */
class ConnectRepository extends Connect
{
    /**
     * function New user INSERT
     */
    public function newUser()
    {
        $db = $this->getDb();

        $pseudo  =$_SESSION['pseudo'];
        $pass = $_SESSION['pass'];
        $email = $_SESSION['email'];

        $reqInsert = 'INSERT INTO user(pseudo, pass, createdAt, email)' ;
        $reqValues = 'VALUES(:pseudo, :pass, now(), :email)';
        $req = $db->prepare($reqInsert . $reqValues);
        $req->execute(array(
        'pseudo' => $pseudo,
        'pass' => $pass,
        'email' => $email));
    }
    /**
     * function SELECT user
     */
    public function existPseudo()
    {
        $db = $this->getDb();

        $req = $db->prepare('SELECT COUNT(pseudo) FROM user WHERE pseudo = :pseudo');
        $req->execute(array(
    'pseudo' => $_SESSION['pseudo']));
        $isAvailable = $req->fetch();

        return $isAvailable;
    }

    /**
     * function SELECT user
     */
    public function getUser()
    {
        $db = $this->getDb();

        $req = $db->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
        $req->execute(array(
    'pseudo' => $_SESSION['pseudo']));
        $user = $req->fetch();

        return $user;
    }
}
