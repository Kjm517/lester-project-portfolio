<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ExperienceController;
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

?>