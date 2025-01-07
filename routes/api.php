<?php

use App\Infrastructure\Http\Controllers\ChallengeGroup\CreateChallengeGroupController;
use App\Infrastructure\Http\Controllers\ChallengeGroup\DeleteChallengeGroupController;
use App\Infrastructure\Http\Controllers\ChallengeGroup\GetChallengeGroupController;
use App\Infrastructure\Http\Controllers\ChallengeGroup\UpdateChallengeGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('challenge-group')->group(function () {
        Route::post('/',  [CreateChallengeGroupController::class, 'create']);
        Route::get('/{id}',  [GetChallengeGroupController::class, 'get']);
        Route::put('/{id}',  [UpdateChallengeGroupController::class, 'update']);
        Route::delete('/{id}',  [DeleteChallengeGroupController::class, 'delete']);
    });
});
