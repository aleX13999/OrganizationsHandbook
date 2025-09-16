<?php

namespace App\Swagger;

/**
 * @OA\Info(
 *     title="Handbook API",
 *     version="1.0.0",
 *     description="This is the API documentation for the Organization Handbook API."
 * )
 *
 * @OA\SecurityScheme(
 *       securityScheme="ApiKeyAuth",
 *       type="apiKey",
 *       in="header",
 *       name="X-API-KEY",
 *       description="Статический API ключ"
 *   )
 */
class ApiDocumentation
{
}
