<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/16/2017
 * Time: 1:40 PM
 */

namespace App\Entities;
use \Doctrine\Common\Persistence\PersistentObject;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class MessageEntity extends PersistentObject
{
    /**
     * @ORM\ManyToOne(targetEntity="UserEntity", inversedBy="id")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $userId;

    /**
     * @ORM\Column(type="string")
     */
    private $message;

    public function scopeMostRecent($query)
    {
        return $query->orderBy('created_at', 'desc')->limit(10);
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

}