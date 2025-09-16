<?php

namespace App\App\Organization\Connector\Query\OrganizationListByBuildingId;

use App\App\Organization\Repository\OrganizationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class OrganizationListByBuildingIdQuery
{
    public function __construct(
        private OrganizationRepositoryInterface $repository,
    ) {}

    public function execute(int $buildingId): Collection
    {
        return $this->repository->getByBuildingId($buildingId);
    }
}
