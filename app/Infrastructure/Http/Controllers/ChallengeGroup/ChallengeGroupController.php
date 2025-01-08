<?php

namespace App\Infrastructure\Http\Controllers\ChallengeGroup;

use App\Application\ChallengeGroups\DTOs\ChallengeGroupDTO;
use App\Application\ChallengeGroups\UseCases\CreateChallengeGroupUseCase;
use App\Application\ChallengeGroups\UseCases\DeleteChallengeGroupUseCase;
use App\Application\ChallengeGroups\UseCases\GetChallengeGroupUseCase;
use App\Application\ChallengeGroups\UseCases\UpdateChallengeGroupUseCase;
use App\Infrastructure\Http\Controllers\Controller;
use App\Infrastructure\Http\Requests\ChallengeGroup\CreateChallengeGroupRequest;
use App\Infrastructure\Http\Requests\ChallengeGroup\UpdateChallengeGroupRequest;
use App\Infrastructure\Http\Resources\ChallengeGroup\ChallengeGroupResource;
use Illuminate\Http\JsonResponse;

class ChallengeGroupController extends Controller
{
    public function create(CreateChallengeGroupRequest $request, CreateChallengeGroupUseCase $use_case): JsonResponse
    {
        $challenge_group = $use_case->execute(auth()->user()->toDTO(), $request->toDTO());
        return (new ChallengeGroupResource($challenge_group))
            ->response()
            ->setStatusCode(201);
    }

    public function get(int $id, GetChallengeGroupUseCase $use_case): JsonResponse
    {
        $challenge_group = $use_case->execute(auth()->user()->toDTO(), new ChallengeGroupDTO($id));
        return (new ChallengeGroupResource($challenge_group))
            ->response()
            ->setStatusCode(200);
    }

    public function update(UpdateChallengeGroupRequest $request, int $id, UpdateChallengeGroupUseCase $use_case): JsonResponse
    {
        $challenge_group = $use_case->execute(auth()->user()->toDTO(), $request->toDto());
        return (new ChallengeGroupResource($challenge_group))
            ->response()
            ->setStatusCode(200);
    }

    public function delete(int $id, DeleteChallengeGroupUseCase $use_case): JsonResponse
    {
        $use_case->execute(auth()->user()->toDTO(), new ChallengeGroupDTO($id));
        return response()->json()->setStatusCode(200);
    }
}
