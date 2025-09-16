<?php

namespace App\Http\Controllers\Api;

use App\App\Building\Connector\Query\BuildingList\BuildingListQuery;
use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Buildings",
 *     description="Методы для работы со зданиями"
 * )
 */
class BuildingController extends Controller
{
    public function __construct(
        private readonly BuildingListQuery $buildingListQuery,
    ) {}

    /**
     * @OA\Get(
     *     path="/api/buildings",
     *     summary="Список всех зданий",
     *     tags={"Buildings"},
     *     security={{"ApiKeyAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Список зданий",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Ошибка аутентификации"
     *     )
     * )
     */
    public function listBuildings(): JsonResponse
    {
        $buildings = $this->buildingListQuery->execute();

        return new JsonResponse(['data' => BuildingResource::collection($buildings)]);
    }
}
