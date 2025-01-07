<?php

namespace App\Infrastructure\Http\Controllers\ChallengeGroup;

use App\Application\ChallengeGroups\DTOs\GetChallengeGroupDTO;
use App\Application\ChallengeGroups\UseCases\GetChallengeGroupUseCase;
use App\Infrastructure\Http\Controllers\Controller;
use App\Infrastructure\Http\Resources\ChallengeGroup\ChallengeGroupResource;
use Illuminate\Http\JsonResponse;

class GetChallengeGroupController extends Controller
{
    public function __construct(
        private readonly GetChallengeGroupUseCase $get
    ) {}

    public function get(int $id): JsonResponse
    {
        $challenge_group = $this->get->execute(
            auth()->user()->toDTO(),
            new GetChallengeGroupDTO($id)
        );
        return (new ChallengeGroupResource($challenge_group))
            ->response()
            ->setStatusCode(200);
    }
}
