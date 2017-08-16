<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/16/2017
 * Time: 3:42 PM
 */

namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="widgets")
 */

class WidgetEntity
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
    private $slug;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * WidgetEntity constructor.
     * @param $user
     * @param $slug
     * @param $name
     */
    public function __construct($user, $slug, $name)
    {
        $this->user = $user;
        $this->slug = $slug;
        $this->name = $name;
    }
}