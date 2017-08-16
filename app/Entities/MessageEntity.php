<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/16/2017
 * Time: 1:40 PM
 */

namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="messages")
 */
class MessageEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="UserEntity", inversedBy="messages")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="string")
     */
    private $message;

    /**
     * MessageEntity constructor.
     * @param $user
     * @param $message
     */
    public function __construct($user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function scopeMostRecent($query)
    {
        return $query->orderBy('created_at', 'desc')->limit(10);
    }



    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

}