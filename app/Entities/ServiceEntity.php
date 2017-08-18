<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/18/2017
 * Time: 11:28 AM
 */

namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="services")
 */
class ServiceEntity
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
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $serviceId;

    /**
     * @ORM\OneToMany(targetEntity="DSEntity", mappedBy="service")
     */
    private $DSs;

    /**
     * @ORM\OneToMany(targetEntity="MinistryEntity", mappedBy="service")
     */
    private $Ministries;


    /**
     * @ORM\OneToMany(targetEntity="EmployeeEntity", mappedBy="currentService")
     */
    private $employees;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * @param mixed $serviceId
     */
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    /**
     * @return mixed
     */
    public function getDSs()
    {
        return $this->DSs;
    }

    /**
     * @param mixed $DSs
     */
    public function setDSs($DSs)
    {
        $this->DSs = $DSs;
    }

    /**
     * @return mixed
     */
    public function getMinistries()
    {
        return $this->Ministries;
    }

    /**
     * @param mixed $Ministries
     */
    public function setMinistries($Ministries)
    {
        $this->Ministries = $Ministries;
    }

    /**
     * @return mixed
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param mixed $employees
     */
    public function setEmployees($employees)
    {
        $this->employees = $employees;
    }

    /**
     * ServiceEntity constructor.
     * @param $type
     * @param $serviceId
     */
    public function __construct($type, $serviceId)
    {
        $this->type = $type;
        $this->serviceId = $serviceId;
        $this->employees = new ArrayCollection();
        $this->DSs = new ArrayCollection();
        $this->Ministries = new ArrayCollection();
    }
}