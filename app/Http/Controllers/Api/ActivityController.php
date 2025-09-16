<?php

namespace App\Http\Controllers\Api;

use App\App\Activity\Connector\Query\ActivityTreeQuery;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Activities",
 *     description="Методы для работы с деятельностями"
 * )
 */
class ActivityController extends Controller
{
    public function __construct(
        private readonly ActivityTreeQuery $activityTreeQuery,
    ) {}

    /**
     * @OA\Get(
     *     path="/api/activities",
     *     summary="Дерево деятельностей",
     *     tags={"Activities"},
     *     security={{"ApiKeyAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Дерево деятельностей",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Ошибка аутентификации"
     *     )
     * )
     */
    public function activityTree(): JsonResponse
    {
        $activities = $this->activityTreeQuery->execute();

        return new JsonResponse(['data' => ActivityResource::collection($activities)]);
    }
}
