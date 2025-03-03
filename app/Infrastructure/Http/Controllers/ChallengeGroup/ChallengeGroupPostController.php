<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controllers\ChallengeGroup;

use App\Application\ChallengeGroups\UseCases\AddChallengeGroupPostUseCase;
use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFoundException;
use App\Domain\ChallengeGroup\Exceptions\UserNotAllowedToPostException;
use App\Infrastructure\Http\Controllers\Controller;
use App\Infrastructure\Http\Requests\ChallengeGroup\AddChallengeGroupPostRequest;
use Illuminate\Http\Response;

final class ChallengeGroupPostController extends Controller
{
    /**
     * @throws ChallengeGroupNotFoundException
     * @throws UserNotAllowedToPostException
     */
    public function post(int $id, AddChallengeGroupPostRequest $request, AddChallengeGroupPostUseCase $use_case): Response
    {
        $use_case->execute((int) auth()->id(), $request->toDTO());

        return response(status: 200);
    }
}
