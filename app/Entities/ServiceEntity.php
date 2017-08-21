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
     * @ORM\OneToOne(targetEntity="DSEntity", mappedBy="service")
     */
    private $DS;
    /**
     * @ORM\OneToOne(targetEntity="MinistryEntity", mappedBy="service")
     */
    private $Ministry;
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
    }

    public function getService(){
        if($this->getServiceId() == 1){
            return ($this->Ministry);
        }
        else if($this->getServiceId()){
            return ($this->DS);
        }
    }
}