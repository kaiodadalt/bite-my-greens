<?php

use App\Infrastructure\Http\Controllers\ChallengeGroup\ChallengeGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('challenge-group')->group(function () {
        Route::post('/',  [ChallengeGroupController::class, 'create']);
        Route::get('/{id}',  [ChallengeGroupController::class, 'get']);
        Route::put('/{id}',  [ChallengeGroupController::class, 'update']);
        Route::delete('/{id}',  [ChallengeGroupController::class, 'delete']);
    });
});
