<?php

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

Route::get('/levels', [LevelController::class, 'index']);
Route::get('/levels/{id}', [LevelController::class, 'show']);

Route::apiResource('/eleves', EleveController::class);
Route::get('/classe/eleves/{id}', [EleveController::class, 'byClasse']);
