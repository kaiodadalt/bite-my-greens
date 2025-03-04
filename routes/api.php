<?php

declare(strict_types=1);

use App\Infrastructure\Http\Controllers\ChallengeGroup\ChallengeGroupController;
use App\Infrastructure\Http\Controllers\ChallengeGroup\ChallengeGroupPostController;
use App\Infrastructure\Http\Controllers\ChallengeGroup\ChallengeGroupUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('challenge-group')->group(function () {
        // TODO: Create this route
        // Route::get('/', [ChallengeGroupController::class, 'getAll'])->name('challenge-group.all');

        Route::post('/', [ChallengeGroupController::class, 'create'])->name('challenge-group.create');

        Route::get('/{id}', [ChallengeGroupController::class, 'get'])->name('challenge-group.get');
        Route::put('/{id}', [ChallengeGroupController::class, 'update'])->name('challenge-group.update');
        Route::delete('/{id}', [ChallengeGroupController::class, 'delete'])->name('challenge-group.delete');

        Route::post('/{id}/post', [ChallengeGroupPostController::class, 'post'])->name('challenge-group.post');

        Route::post('/join', [ChallengeGroupUserController::class, 'join'])->name('challenge-group.join');
        Route::post('/exit', [ChallengeGroupUserController::class, 'exit'])->name('challenge-group.exit');

    });
});
