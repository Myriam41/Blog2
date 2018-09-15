<?php

namespace App\Entity;

/**
 * Class Comment
 */
class Comment
{
    /**
     * @var int primary key auto incremented
     */
    private $id;

    /**
     * @var int secondary key
     */
    private $postId;
  
    /**
     * @var string comment's message
     */
    private $contmessage;
    
    /**
     * @var string comment's author
     */
    private $author;
    
    /**
     * @var string comment's createdAt
     */
    private $createdAt;
        
    /**
     * @var string comment's updateAt
     */
    private $updateAt;
    
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

            if (isset($data['postId'])) {
                $this->setPostId($data['postId']);
            }
            
            if (isset($data['contmessage'])) {
                $this->setContMessage($data['contmessage']);
            }

            if (isset($data['author'])) {
                $this->setAuthor($data['author']);
            }

            if (isset($data['createdAt'])) {
                $this->setCreatedAt($data['createdAt']);
            }

            if (isset($data['updateAt'])) {
                $this->setUpdateAt(['updateAt']);
            }
        }
    }

    /**
     * @param int $id
     */
    public function setId($Id)
    {
        $this->id = $Id;
    }

    /**
     * @return int id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $postId
     */
    public function setPostId($postId)
    {
        $this->postId =$postId;
    }

    /**
    * @return string postId
    */
    public function getPostId()
    {
        return $this->postId;
    }
    
    /**
     * @param string $contmessage
     */
    public function setContMessage()
    {
        $this->contmessage = $contmessage;
    }

    /**
    * @return string contmessage
    */
    public function getContMessage()
    {
        return $this->contmessage;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
    * @return string author
    */
    public function getAuthor()
    {
        return $this->author;
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
     * @param int $updateAt
     */
    public function setUpdateAt()
    {
        $this->updateAt = $updateAt;
    }

    /**
    * @return string updateAt
    */
    public function getUpdateAt()
    {
        return $this->updatedAt;
    }
}
