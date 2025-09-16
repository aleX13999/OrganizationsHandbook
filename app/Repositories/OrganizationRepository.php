<?php

namespace App\Repositories;

use App\App\Organization\Repository\OrganizationRepositoryInterface;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    public function getOne(int $id): ?Organization
    {
        return Organization::find($id);
    }

    public function getByBuildingId(int $buildingId): Collection
    {
        return Organization::query()->where('building_id', $buildingId)->with(['building', 'activities', 'phones'])->get();
    }

    public function getByActivityId(array $activityIds): Collection
    {
        return Organization::query()->whereHas('activities', function ($q) use ($activityIds) {
            $q->whereIn('activities.id', $activityIds);
        })->get();
    }

    public function getByName(string $name): ?Organization
    {
        return Organization::query()->where('name', $name)->first();
    }

    public function getInArea(float $latitude, float $longitude, float $radius): Collection
    {
        return Organization::select('organizations.*')
                           ->join('buildings', 'organizations.building_id', '=', 'buildings.id')
                           ->selectRaw("(6371 * acos(cos(radians(?)) * cos(radians(buildings.latitude))
        * cos(radians(buildings.longitude) - radians(?)) + sin(radians(?)) * sin(radians(buildings.latitude)))) AS distance", [$latitude, $longitude, $latitude])
                           ->having('distance', '<=', $radius)
                           ->orderBy('distance')
                           ->get();
    }
}
