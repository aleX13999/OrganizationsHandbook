<?php

namespace App\App\Organization\Connector\Query\OrganizationByName;

use App\App\Organization\Repository\OrganizationRepositoryInterface;
use App\Models\Organization;

readonly class OrganizationByNameQuery
{
    public function __construct(
        private OrganizationRepositoryInterface $repository,
    ) {}

    public function execute(string $name): ?Organization
    {
        return $this->repository->getByName($name);
    }
}
