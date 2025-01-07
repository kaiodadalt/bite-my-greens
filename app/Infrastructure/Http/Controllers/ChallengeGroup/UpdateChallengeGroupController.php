<?php

namespace App\Infrastructure\Http\Controllers\ChallengeGroup;

use App\Application\ChallengeGroups\UseCases\UpdateChallengeGroupUseCase;
use App\Infrastructure\Http\Controllers\Controller;
use App\Infrastructure\Http\Requests\ChallengeGroup\UpdateChallengeGroupRequest;
use App\Infrastructure\Http\Resources\ChallengeGroup\ChallengeGroupResource;
use Illuminate\Http\JsonResponse;

class UpdateChallengeGroupController extends Controller
{
    public function __construct(
        private readonly UpdateChallengeGroupUseCase $update
    ) {}

    public function update(UpdateChallengeGroupRequest $request, int $id): JsonResponse
    {
        $challenge_group = $this->update->execute(auth()->user()->toDTO(), $request->toDto());
        return (new ChallengeGroupResource($challenge_group))
            ->response()
            ->setStatusCode(200);
    }
}
