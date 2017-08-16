<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/16/2017
 * Time: 1:38 PM
 */

namespace App\Entities;
use App\Traits\ShowsImages;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="images")
 */
class MarketingImageEntity extends SuperEntity
{
    use ShowsImages;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $isActive;
    /**
     * @ORM\Column(type="string")
     */
    private $isFeatured;

    /**
     * @return mixed
     */
    public function getisActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getisFeatured()
    {
        return $this->isFeatured;
    }

    /**
     * @param mixed $isFeatured
     */
    public function setIsFeatured($isFeatured)
    {
        $this->isFeatured = $isFeatured;
    }

    /**
     * @return mixed
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param mixed $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return mixed
     */
    public function getImageExtension()
    {
        return $this->imageExtension;
    }

    /**
     * @param mixed $imageExtension
     */
    public function setImageExtension($imageExtension)
    {
        $this->imageExtension = $imageExtension;
    }

    /**
     * @return mixed
     */
    public function getImageWeight()
    {
        return $this->imageWeight;
    }

    /**
     * @param mixed $imageWeight
     */
    public function setImageWeight($imageWeight)
    {
        $this->imageWeight = $imageWeight;
    }
    /**
     * @ORM\Column(type="string")
     */
    private $imageName;
    /**
     * @ORM\Column(type="string")
     */
    private $imageExtension;
    /**
     * @ORM\Column(type="string")
     */
    private $imageWeight;


    public function showActiveStatus($is_active)
    {

        return $is_active == 1 ? 'Yes' : 'No';

    }

    public function showFeaturedStatus($is_featured)
    {

        return $is_featured == 1 ? 'Yes' : 'No';

    }
}