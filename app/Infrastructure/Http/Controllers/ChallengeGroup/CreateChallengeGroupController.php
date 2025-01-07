<?php

namespace App\Infrastructure\Http\Controllers\ChallengeGroup;

use App\Application\ChallengeGroups\UseCases\CreateChallengeGroupUseCase;
use App\Infrastructure\Http\Controllers\Controller;
use App\Infrastructure\Http\Requests\ChallengeGroup\CreateChallengeGroupRequest;
use App\Infrastructure\Http\Resources\ChallengeGroup\ChallengeGroupResource;
use Illuminate\Http\JsonResponse;

class CreateChallengeGroupController extends Controller
{
    public function __construct(
        private readonly CreateChallengeGroupUseCase $create
    ) {}

    public function create(CreateChallengeGroupRequest $request): JsonResponse
    {
        $challenge_group = $this->create->execute($request->toDTO());
        return (new ChallengeGroupResource($challenge_group))
            ->response()
            ->setStatusCode(201);
    }
}
