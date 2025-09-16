<?php

namespace App\App\Building\Connector\Query\BuildingList;

use App\App\Building\Repository\BuildingRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class BuildingListQuery
{
    public function __construct(
        private BuildingRepositoryInterface $repository,
    ) {}

    public function execute(): Collection
    {
        return $this->repository->getAll();
    }
}
