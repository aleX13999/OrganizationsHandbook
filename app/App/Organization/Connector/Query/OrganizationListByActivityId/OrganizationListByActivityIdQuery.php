<?php

namespace App\App\Organization\Connector\Query\OrganizationListByActivityId;

use App\App\Activity\Repository\ActivityRepositoryInterface;
use App\App\Organization\Repository\OrganizationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class OrganizationListByActivityIdQuery
{
    public function __construct(
        private ActivityRepositoryInterface     $activityRepository,
        private OrganizationRepositoryInterface $organizationRepository,
    ) {}

    public function execute(int $activityId): Collection
    {
        $activities = $this->activityRepository->getByParentId($activityId);

        $activityIds = [$activityId];
        foreach ($activities as $activity) {
            $activityIds[] = $activity->id;
        }

        return $this->organizationRepository->getByActivityId($activityIds);
    }
}
