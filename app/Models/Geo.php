<?php

namespace App\Models;

class Geo extends Model
{
    public function getRegions()
    {
        $query = $this->db
        ->table('regions')
        ->select(['region_name'])
        ->get();

        $regions = array_column($query, 'region_name');
        return $regions;
    }

    public function getCities($nameRegion)
    {
        $idRegion = $this->db
        ->table('regions')
        ->select(['region_id'])
        ->where('region_name', '=', $nameRegion)
        ->pluck('region_id');

        $cities = $this->db
        ->table('cities')
        ->select(['city_name'])
        ->where('region_id', '=' , $idRegion)
        ->get();

        $cities = array_column($cities, 'city_name');
        return $cities;
    }
}