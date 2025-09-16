<?php

namespace App\Repositories;

use App\App\Activity\Repository\ActivityRepositoryInterface;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Collection;

class ActivityRepository implements ActivityRepositoryInterface
{
    public function getByParentId(int $id): Collection
    {
        $query = Activity::query();

        $query
            ->where('path', 'like', '%/' . $id . '/%')
            ->where('level', '<=', 2);

        return $query->get();
    }
}
