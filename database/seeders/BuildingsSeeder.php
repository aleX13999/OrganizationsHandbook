<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Seeder;

class BuildingsSeeder extends Seeder
{
    protected array $buildings = [
        [
            'address' => 'г. Москва, ул. Ленина 1, офис 3',
            'latitude' => 55.755826,
            'longitude' => 37.6173,
        ],
        [
            'address' => 'г. Москва, проспект Мира, д. 100',
            'latitude' => 55.7913,
            'longitude' => 37.6220,
        ],
        [
            'address' => 'г. Москва, ул. Тверская, 7',
            'latitude' => 56.7648,
            'longitude' => 36.6057,
        ],
        [
            'address' => 'г. Санкт-Петербург, Невский проспект, 12',
            'latitude' => 59.9343,
            'longitude' => 30.3351,
        ],
        [
            'address' => 'г. Санкт-Петербург, Лиговский проспект, 41/83',
            'latitude' => 60.9247,
            'longitude' => 31.3441,
        ],
    ];

    public function run(): void
    {
        foreach ($this->buildings as $building) {
            Building::firstOrCreate($building);
        }
    }
}
