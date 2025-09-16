<?php

namespace App\App\Activity\Repository;

use Illuminate\Database\Eloquent\Collection;

interface ActivityRepositoryInterface
{
    public function getByParentId(int $id): Collection;
}
