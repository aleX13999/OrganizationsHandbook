<?php

namespace App\Repositories;

use App\App\Building\Repository\BuildingRepositoryInterface;
use App\Models\Building;
use Illuminate\Database\Eloquent\Collection;

class BuildingRepository implements BuildingRepositoryInterface
{
    public function getAll(): Collection
    {
        return Building::query()->with(['organizations', 'organizations.activities', 'organizations.phones'])->get();
    }
}
