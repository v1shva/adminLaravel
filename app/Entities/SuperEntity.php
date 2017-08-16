<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/16/2017
 * Time: 12:24 PM
 */
namespace App\Entities;
use \Doctrine\Common\Persistence\PersistentObject;
use \Doctrine\ORM\EntityManager;
use Carbon\Carbon;


class SuperEntity extends PersistentObject
{
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('m-d-Y');
    }
}