<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/16/2017
 * Time: 1:38 PM
 */

namespace App\Entities;
use App\Traits\ShowsImages;

class MarketingImageEntity extends SuperEntity
{
    use ShowsImages;

    protected $fillable = ['is_active',
        'is_featured',
        'image_name',
        'image_extension',
        'image_weight'];

    public function showActiveStatus($is_active)
    {

        return $is_active == 1 ? 'Yes' : 'No';

    }

    public function showFeaturedStatus($is_featured)
    {

        return $is_featured == 1 ? 'Yes' : 'No';

    }
}