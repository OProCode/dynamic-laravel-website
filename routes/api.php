<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DefinitionRatingController;
use App\Http\Controllers\API\WordTypeController;
use App\Http\Controllers\API\WordController;
use App\Http\Controllers\API\DefinitionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * AUTHENTICATION
 */
Route::post('/auth/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/auth/logout', [AuthController::class, 'logout']);

/**
 * WORDS
 */
Route::apiResource('/words', WordController::class)->only(['index', 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/words', WordController::class)->except(['index', 'show']);
});

/**
 * WORD TYPES
 */
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/wordtypes', WordTypeController::class);
});

/**
 * DEFINITIONS
 */
Route::apiResource('/definitions', DefinitionController::class)->only(['index', 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/definitions', DefinitionController::class)->except(['index', 'show']);
});

/**
 * DEFINITION RATINGS
 */
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/definitionratings', DefinitionRatingController::class);
});
