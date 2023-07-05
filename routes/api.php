<?php

use App\Http\Controllers\ClasseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\LevelController;

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

Route::apiResource('/levels', LevelController::class);

Route::apiResource('/eleves', EleveController::class);

Route::apiResource('/classes', ClasseController::class);

Route::get('/classes/{id}/eleves', [ClasseController::class, 'allStudents']);
Route::get('/classes/{id}/coef', [ClasseController::class, 'listCoef']);
Route::post('/classes/{id}/coef', [ClasseController::class, 'addCoef']);
