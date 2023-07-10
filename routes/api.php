<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\EvaluationController;

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

Route::prefix('/users')->controller(UserController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
});

Route::put('/eleves/sortie', [EleveController::class, 'getOut']);

Route::prefix('/classes')->controller(ClasseController::class)->group(function () {
    Route::get('/{id}/eleves', [ClasseController::class, 'allStudents']);
    Route::get('/{id}/coef', [ClasseController::class, 'listCoef']);
    Route::post('/{id}/coef', [ClasseController::class, 'addCoef']);
});

Route::apiResource('/eleves', EleveController::class)->parameters(['eleves' => 'eleve']);
Route::apiResource('/classes', ClasseController::class)->parameters(['classes' => 'classe']);

Route::apiResources([
    '/levels' => LevelController::class,
    '/disciplines' => DisciplineController::class,
    '/evaluations' => EvaluationController::class
]);

Route::prefix('/classes')->controller(MarkController::class)->group(function () {
    Route::get("/{classe_id}/disciplines/{discipline_id}/notes", "getStudentNotesBySubjectId");
    Route::get("/{id}/notes", 'getStudentNotesByClasseId');
    Route::get("/{classe_id}/notes/eleves/{eleve_id}", 'getNotesByStudentId');
    Route::post("/{classe_id}/discipline/{discipline_id}/evaluation/{evaluation_id}", 'addMark');
});

Route::prefix('/events')->controller(EventController::class)->group(function () {
    Route::get("/", 'index');
    Route::post("/", 'store');
    Route::post("/{id}/participations", 'addParticipations');
});
