<?php

declare(strict_types=1);

namespace App\Models;

class Geo extends Model
{
    public function getRegions() :array
    {
        return array_column(
            $this->queryBuilder
            ->table('regions')
            ->select(['region_name'])
            ->get(), 'region_name'
        );
    }

    public function getCities(string $nameRegion) :array
    {
        $idRegion = $this->queryBuilder
        ->table('regions')
        ->select(['region_id'])
        ->where('region_name', '=', $nameRegion)
        ->pluck('region_id');

        return array_column(
            $this->queryBuilder
            ->table('cities')
            ->select(['city_name'])
            ->where('region_id', '=' , $idRegion)
            ->get(), 'city_name'
        );
    }
}