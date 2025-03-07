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
        Route::get('/', [ChallengeGroupController::class, 'getAll'])->name('challenge-group.all');
        Route::post('/', [ChallengeGroupController::class, 'create'])->name('challenge-group.create');
        Route::post('/join', [ChallengeGroupUserController::class, 'join'])->name('challenge-group.join');
        Route::post('/exit', [ChallengeGroupUserController::class, 'exit'])->name('challenge-group.exit');

        Route::prefix('{id}')->group(function () {
            Route::get('/', [ChallengeGroupController::class, 'get'])->name('challenge-group.get');
            Route::put('/', [ChallengeGroupController::class, 'update'])->name('challenge-group.update');
            Route::delete('/', [ChallengeGroupController::class, 'delete'])->name('challenge-group.delete');
            Route::post('/post', [ChallengeGroupPostController::class, 'post'])->name('challenge-group.post');
        });
    });
});
