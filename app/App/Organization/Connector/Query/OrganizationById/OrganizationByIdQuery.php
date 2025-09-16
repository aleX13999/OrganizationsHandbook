<?php

namespace App\App\Organization\Connector\Query\OrganizationById;

use App\App\Organization\Repository\OrganizationRepositoryInterface;
use App\Models\Organization;

readonly class OrganizationByIdQuery
{
    public function __construct(
        private OrganizationRepositoryInterface $repository,
    ) {}

    public function execute(int $id): ?Organization
    {
        return $this->repository->getOne($id);
    }
}
