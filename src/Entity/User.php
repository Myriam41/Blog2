<?php

namespace App\Entity;

/**
 * Class User
 */
class User
{
    /**
     * @var int primary key auto incremented
     */
    private $id;

    /**
     * @var string userpseudo
     */
    private $pseudo;

    /**
     * @var string user's password
     */
    private $pass;

    /**
     * @var string user's statut
     */
    private $statut;

    /**
     * @var string user's inscription date
     */
    private $createdAt;

    /**
     * @var string user's email
     */
    private $email;

    /**
     * @var string user's phone
     */
    private $phone;

    /**
     * @param string $data use function hydrate
     */
    public function __construct($data)
    {
        if (isset($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * @param string $data hydrate attributs with data
     */
    public function hydrate($data)
    {
    
        /**
         * if $data is an array. The value of each column is retrieved
         */
        if (is_array($data)) {
            if (isset($data['id'])) {
                $this->setId($data['id']);
            }
             
            if (isset($data['pseudo'])) {
                $this->setpseudo($data['pseudo']);
            }
            
            if (isset($data['pass'])) {
                $this->setPass($data['pass']);
            }

            if (isset($data['statut'])) {
                $this->setStatut($data['statut']);
            }

            if (isset($data['email'])) {
                $this->setemail($data['email']);
            }

            if (isset($data['createdAt'])) {
                $this->setCreatedAt($data['createdAt']);
            }

            if (isset($data['phone'])) {
                $this->setPhone(['phone']);
            }
        }
    }

    /**
     * @return int id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    private function setId($id)
    {
        $this->id = $id;
    }

    /**
    * @return string pseudo
    */
    public function getpseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setpseudo($pseudo)
    {
        $this->pseudo = htmlspecialchars($pseudo);
    }

    /**
    * @return string status
    */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatut($status)
    {
        $this->status = $status;
    }

    /**
     * @return string password
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param string $password
     */
    public function setPass($pass)
    {
        $this->pass = htmlspecialchars($pass);
    }

    /**
     * @return int createAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param int $createAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createAt = $createdAt;
    }

    /**
    * @return string email
    */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = htmlspecialchars($email);
    }
    /**
    * @return string phone
    */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = htmlspecialchars($phone);
    }
}
