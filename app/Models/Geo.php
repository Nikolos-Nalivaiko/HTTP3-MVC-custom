<?php

declare(strict_types=1);

namespace App\Models;

class Geo extends Model
{
    public function getRegions(): array
    {
        return array_column(
            $this->db
                ->table('regions')
                ->select(['region_name'])
                ->get(),
            'region_name'
        );
    }

    public function getCities($nameRegion): array
    {
        $idRegion = $this->db
            ->table('regions')
            ->select(['region_id'])
            ->where('region_name', '=', $nameRegion)
            ->pluck('region_id');

        $cities = $this->db
            ->table('cities')
            ->select(['city_name'])
            ->where('region_id', '=', $idRegion)
            ->get();

        return array_column($cities, 'city_name');
    }
}