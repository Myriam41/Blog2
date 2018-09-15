<?php

namespace App\Model;

use \PDO;

/**
 * class Connect
 * @abstract
 */
abstract class Connect
{
    /**
     * @var int
     * data to connect with database
     */
    private $db;

    /**
     * Function to connect
     * @return db
     */
    protected function getDb()
    {
        if ($this->db === null) {
            try {
                $db = new \PDO('mysql:dbname=viva;host=localhost;charset=utf8', 'root', '');

                $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                $this->db = $db;

                return $this->db;
            } catch (PDOException $e) {
                die('Echec lors de la connexion : '.$e->getMessage());
            }
        }

        return $this->db;
    }

    /**
     * Function to secure data 
     */
    protected function secure_db($data)
    {
        // check if data is an integer
        if (ctype_digit($data)) {
            $data=intval($data);
        }

        // other type
        else {
            $data=mysql_real_escape_string($data);
            $data=addcslashes($data, '%_');
        }
    }
}
