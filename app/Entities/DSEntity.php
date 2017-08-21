<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/18/2017
 * Time: 4:47 PM
 */

namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dss")
 */
class DSEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $district;

    /**
     * @ORM\OneToOne(targetEntity="ServiceEntity", inversedBy="serviceId")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     */
    private $service;
}