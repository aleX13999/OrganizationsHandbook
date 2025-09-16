<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\BuildingController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Middleware\CheckApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([CheckApiKey::class])->group(function () {
    Route::prefix('organizations')->group(function () {
        Route::get('/search', [OrganizationController::class, 'organizationBySearch']);
        Route::get('/area', [OrganizationController::class, 'organizationsInArea']);
        Route::get('/buildings/{id}', [OrganizationController::class, 'organizationsByBuilding']);
        Route::get('/activities/{id}', [OrganizationController::class, 'organizationsByActivity']);
        Route::get('/{id}', [OrganizationController::class, 'organization']);
    });
    Route::get('/buildings', [BuildingController::class, 'listBuildings']);
    Route::get('/activities', [ActivityController::class, 'activityTree']);
});
