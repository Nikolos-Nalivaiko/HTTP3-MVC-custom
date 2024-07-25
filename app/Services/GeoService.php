<?php

declare(strict_types=1);

namespace App\Services;

use Core\Models\Geo;

class GeoService
{
    private Geo $geoModel;

    public function __construct()
    {
        $this->geoModel = new Geo();        
    }

    public function getRegions() :array
    {
        return $this->geoModel->getRegions();
    }

    public function getCities(string $region) :array
    {
        return $this->geoModel->getCities($region);
    }
}