<?php

use App\Infrastructure\Http\Controllers\ChallengeGroup\CreateChallengeGroupController;
use App\Infrastructure\Http\Controllers\ChallengeGroup\UpdateChallengeGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/challenge-group',  [CreateChallengeGroupController::class, 'create']);
    Route::put('/challenge-group/{id}',  [UpdateChallengeGroupController::class, 'update']);
});
