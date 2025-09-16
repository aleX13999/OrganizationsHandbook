<?php

namespace App\App\Activity\Connector\Query;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Collection;

readonly class ActivityTreeQuery
{
    public function execute(int $maxDepth = 3): Collection
    {
        $roots = Activity::whereNull('parent_id')->get();

        $roots->each(function ($activity) use ($maxDepth) {
            $activity->setRelation('children', $activity->getTree($maxDepth));
        });

        return $roots;
    }
}
