<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AwardsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API test route
Route::get('/abouts/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::get('/abouts', [AboutController::class, 'index']);
Route::post('/abouts', [AboutController::class, 'store']);
Route::put('/abouts/{id}', [AboutController::class, 'update']);

Route::get('/experiences', [ExperienceController::class, 'index']);
Route::post('/experiences', [ExperienceController::class, 'store']);
Route::put('/experiences/{id}', [ExperienceController::class, 'update']);
Route::delete('/experiences/{id}', [ExperienceController::class, 'destroy']);

Route::get('/portfolios', [PortfolioController::class, 'index']);
Route::post('/portfolios', [PortfolioController::class, 'store']);
Route::put('/portfolios/{id}', [PortfolioController::class, 'update']);
Route::delete('/portfolios/{id}', [PortfolioController::class, 'destroy']);

Route::get('/awards', [AwardsController::class, 'index']);
Route::post('/awards', [AwardsController::class, 'store']);
Route::put('/awards/{id}', [AwardsController::class, 'update']);
Route::delete('/awards/{id}', [AwardsController::class, 'destroy']);
?>