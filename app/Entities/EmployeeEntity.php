<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/18/2017
 * Time: 11:27 AM
 */

namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="employees")
 */
class EmployeeEntity
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
    private $designation;

    /**
     * @ORM\ManyToOne(targetEntity="ServiceEntity", inversedBy="employees")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     */
    private $currentService;

    /**
     * Many Employees can have many Many Services
     * @ORM\ManyToMany(targetEntity="ServiceEntity")
     * @ORM\JoinTable(name="employee_services",
     *      joinColumns={@ORM\JoinColumn(name="employee_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="service_id", referencedColumnName="id")}
     *      )
     */
    private $services;

    /**
     * One Cart has One Customer.
     * @ORM\OneToOne(targetEntity="UserEntity", inversedBy="employee")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * EmployeeEntity constructor.
     * @param $designation
     * @param $currentService
     */
    public function __construct($designation, $currentService)
    {
        $this->designation = $designation;
        $this->currentService = $currentService;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param mixed $designation
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }

    /**
     * @return mixed
     */
    public function getCurrentService()
    {
        return $this->currentService;
    }

    /**
     * @param mixed $currentService
     */
    public function setCurrentService($currentService)
    {
        $this->currentService = $currentService;
    }


}