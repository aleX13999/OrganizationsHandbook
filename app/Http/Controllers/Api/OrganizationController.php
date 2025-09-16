<?php

namespace App\Http\Controllers\Api;

use App\App\Organization\Connector\Query\OrganizationById\OrganizationByIdQuery;
use App\App\Organization\Connector\Query\OrganizationByName\OrganizationByNameQuery;
use App\App\Organization\Connector\Query\OrganizationListByActivityId\OrganizationListByActivityIdQuery;
use App\App\Organization\Connector\Query\OrganizationListByBuildingId\OrganizationListByBuildingIdQuery;
use App\App\Organization\Connector\Query\OrganizationListInArea\OrganizationListInAreaQuery;
use App\Http\Controllers\Controller;
use App\Http\Requests\Organizations\OrganizationBySearchRequest;
use App\Http\Requests\Organizations\OrganizationsInAreaRequest;
use App\Http\Resources\OrganizationResource;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Organizations",
 *     description="Методы для работы с организациями"
 * )
 */
class OrganizationController extends Controller
{
    public function __construct(
        private readonly OrganizationByIdQuery             $organizationByIdQuery,
        private readonly OrganizationListByBuildingIdQuery $organizationListByBuildingIdQuery,
        private readonly OrganizationListByActivityIdQuery $organizationListByActivityIdQuery,
        private readonly OrganizationByNameQuery           $organizationByNameQuery,
        private readonly OrganizationListInAreaQuery       $organizationListInAreaQuery,
    ) {}

    /**
     * @OA\Get(
     *     path="/api/organizations/buildings/{buildingId}",
     *     summary="Список организаций в здании",
     *     security={{"ApiKeyAuth": {}}},
     *     tags={"Organizations"},
     *     @OA\Parameter(
     *         name="buildingId",
     *         in="path",
     *         required=true,
     *         description="ID здания",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список организаций",
     *     )
     * )
     */
    public function organizationsByBuilding($buildingId): JsonResponse
    {
        $organizations = $this->organizationListByBuildingIdQuery->execute($buildingId);

        return new JsonResponse(['data' => OrganizationResource::collection($organizations)]);
    }

    /**
     * @OA\Get(
     *     path="/api/organizations/activities/{activityId}",
     *     summary="Список организаций по виду деятельности",
     *     security={{"ApiKeyAuth": {}}},
     *     tags={"Organizations"},
     *     @OA\Parameter(
     *         name="activityId",
     *         in="path",
     *         required=true,
     *         description="ID деятельности",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список организаций",
     *     )
     * )
     */
    public function organizationsByActivity($activityId): JsonResponse
    {
        $organizations = $this->organizationListByActivityIdQuery->execute($activityId);

        return new JsonResponse(['data' => OrganizationResource::collection($organizations)]);
    }

    /**
     * @OA\Get(
     *     path="/api/organizations/area",
     *     summary="Список организаций в радиусе от точки",
     *     security={{"ApiKeyAuth": {}}},
     *     tags={"Organizations"},
     *     @OA\Parameter(name="latitude", in="query", required=true, @OA\Schema(type="number", format="float")),
     *     @OA\Parameter(name="longitude", in="query", required=true, @OA\Schema(type="number", format="float")),
     *     @OA\Parameter(name="radius", in="query", required=false, @OA\Schema(type="number", format="float")),
     *     @OA\Response(response=200, description="Список организаций"),
     * )
     */
    public function organizationsInArea(OrganizationsInAreaRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $organizations = $this->organizationListInAreaQuery->execute($validated['latitude'], $validated['longitude'], $validated['radius']);

        return new JsonResponse(['data' => OrganizationResource::collection($organizations)]);
    }

    /**
     * @OA\Get(
     *     path="/api/organizations/{id}",
     *     summary="Детальная информация об организации",
     *     security={{"ApiKeyAuth": {}}},
     *     tags={"Organizations"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID организации",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Информация об организации",
     *     ),
     *     @OA\Response(response=404, description="Организация не найдена")
     * )
     */
    public function organization($id): JsonResponse
    {
        $organization = $this->organizationByIdQuery->execute($id);

        return new JsonResponse(['data' => new OrganizationResource($organization)]);
    }

    /**
     * @OA\Get(
     *     path="/api/organizations/search",
     *     summary="Поиск организации по названию",
     *     security={{"ApiKeyAuth": {}}},
     *     tags={"Organizations"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *         description="Название организации",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Организация",
     *     )
     * )
     */
    public function organizationBySearch(OrganizationBySearchRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $organization = $this->organizationByNameQuery->execute($validated['name']);

        return new JsonResponse(['data' => new OrganizationResource($organization)]);
    }
}
