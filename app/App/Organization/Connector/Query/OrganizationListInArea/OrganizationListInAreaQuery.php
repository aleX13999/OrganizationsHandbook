<?php

namespace App\App\Organization\Connector\Query\OrganizationListInArea;

use App\App\Organization\Repository\OrganizationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class OrganizationListInAreaQuery
{
    public function __construct(
        private OrganizationRepositoryInterface $repository,
    ) {}

    public function execute(float $latitude, float $longitude, float $radius): Collection
    {
        return $this->repository->getInArea($latitude, $longitude, $radius);
    }
}
