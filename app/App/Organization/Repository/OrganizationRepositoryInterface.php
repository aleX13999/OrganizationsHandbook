<?php

namespace App\App\Organization\Repository;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;

interface OrganizationRepositoryInterface
{
    public function getOne(int $id): ?Organization;
    public function getByBuildingId(int $buildingId): Collection;
    public function getByActivityId(array $activityIds): Collection;
    public function getByName(string $name): ?Organization;
    public function getInArea(float $latitude, float $longitude, float $radius): Collection;
}
