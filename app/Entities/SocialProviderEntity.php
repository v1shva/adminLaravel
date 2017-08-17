<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/16/2017
 * Time: 4:18 PM
 */

namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="socialproviders")
 */
class SocialProviderEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="UserEntity")
     */
    private $user;

    /**
     * @ORM\Column(type="string")
     */
    private $source;

    /**
     * @ORM\Column(type="string")
     */
    private $sourceID;

    /**
     * @ORM\Column(type="string")
     */
    private $avatar;

    /**
     * SocialProviderEntity constructor.
     * @param $user
     * @param $source
     * @param $sourceID
     * @param $avatar
     */
    public function __construct($user, $source, $sourceID, $avatar)
    {
        $this->user = $user;
        $this->source = $source;
        $this->sourceID = $sourceID;
        $this->avatar = $avatar;
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
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return mixed
     */
    public function getSourceID()
    {
        return $this->sourceID;
    }

    /**
     * @param mixed $sourceID
     */
    public function setSourceID($sourceID)
    {
        $this->sourceID = $sourceID;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }
}