<?php

declare(strict_types=1);

use App\Infrastructure\Http\Controllers\ChallengeGroup\ChallengeGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('challenge-group')->group(function () {
        Route::post('/', [ChallengeGroupController::class, 'create'])->name('challenge-group.create');
        Route::get('/{id}', [ChallengeGroupController::class, 'get'])->name('challenge-group.get');
        Route::put('/{id}', [ChallengeGroupController::class, 'update'])->name('challenge-group.update');
        Route::delete('/{id}', [ChallengeGroupController::class, 'delete'])->name('challenge-group.delete');

        Route::post('/join', [ChallengeGroupController::class, 'create'])->name('challenge-group.create');
        Route::post('/exit', [ChallengeGroupController::class, 'create'])->name('challenge-group.create');
    });
});
