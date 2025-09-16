<?php

namespace App\App\Building\Repository;

use Illuminate\Database\Eloquent\Collection;

interface BuildingRepositoryInterface
{
    public function getAll(): Collection;
}
