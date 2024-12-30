<?php

use App\Infrastructure\Http\Controllers\ChallengeGroup\ChallengeGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/challenge-group',  [ChallengeGroupController::class, 'create']);
});
