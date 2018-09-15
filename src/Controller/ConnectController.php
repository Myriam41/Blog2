<?php

namespace App\Controller;

use App\Repository\ConnectRepository;
use App\Entity\Log;

/**
 * Class ConnectController
 */
class ConnectController
{
    /**
     * function hach password
     * @return $pass_hache
     */
    public function hach()
    {
        $pass_hache = password_hash($_SESSION['pass'], PASSWORD_DEFAULT);
        return $pass_hache;
    }

    /**
     * function check if pseudo exist already in database
     */
    public function existPseudo()
    {
        $user = new ConnectRepository();
        $isAvailable = $user->getUser();

        // if no pseudo in database
        // intval retourne 0 si le tableau est vide et 1 s'il est rempli. Pas utilisable pour des objets.
        if (intval($isAvailable[0]) == 0) {
            $newUser = new ConnectRepository();
            $newUser->newUser();
        // faire valider l'email
        } else {
            ?> <script> alert("Merci de choisir un autre pseudo")</script>
            <?php
        }
    }

    /**
     * function login
     */
    public function Login()
    {
        // search of the user and his password
        $connectRepository = new ConnectRepository;
        $user = $connectRepository->getUser();

        //check password
        $isPasswordCorrect = password_verify($_SESSION['pass'], $user['pass']);

        if (!$user) {
            echo 'Mauvais identifiant ou mot de passe !';
        } else {
            if ($isPasswordCorrect) {
                $_SESSION['userId'] = $user['id'];
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['status'] = $user['status'];
                $_SESSION['connect'] = 1;
            } else {
                echo 'Mauvais identifiant ou mot de passe !';
            }
        }
    }

    /**
     * function offline
     */
    public function offline()
    {
        //delete session
        $_SESSION = array();

        session_destroy();

        // delete cookies automatic login
        setcookie('login', '');
        setcookie('pass_hache', '');
    }
}
