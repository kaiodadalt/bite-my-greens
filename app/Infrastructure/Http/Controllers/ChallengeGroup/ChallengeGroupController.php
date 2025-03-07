<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controllers\ChallengeGroup;

use App\Application\ChallengeGroups\UseCases\CreateChallengeGroupUseCase;
use App\Application\ChallengeGroups\UseCases\DeleteChallengeGroupUseCase;
use App\Application\ChallengeGroups\UseCases\GetAllChallengeGroupUseCase;
use App\Application\ChallengeGroups\UseCases\GetChallengeGroupUseCase;
use App\Application\ChallengeGroups\UseCases\UpdateChallengeGroupUseCase;
use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFoundException;
use App\Infrastructure\Http\Controllers\Controller;
use App\Infrastructure\Http\Requests\ChallengeGroup\CreateChallengeGroupRequest;
use App\Infrastructure\Http\Requests\ChallengeGroup\UpdateChallengeGroupRequest;
use App\Infrastructure\Http\Resources\ChallengeGroup\ChallengeGroupResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class ChallengeGroupController extends Controller
{
    public function create(CreateChallengeGroupRequest $request, CreateChallengeGroupUseCase $use_case): JsonResponse
    {
        $challenge_group = $use_case->execute((int) auth()->id(), $request->toDTO());

        return (new ChallengeGroupResource($challenge_group))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * @throws ChallengeGroupNotFoundException
     */
    public function get(int $id, GetChallengeGroupUseCase $use_case): JsonResponse
    {
        $challenge_group = $use_case->execute((int) auth()->id(), $id);

        return (new ChallengeGroupResource($challenge_group))
            ->response()
            ->setStatusCode(200);
    }

    public function getAll(GetAllChallengeGroupUseCase $use_case): Response
    {
        $challenge_groups = $use_case->execute((int) auth()->id());

        return response(ChallengeGroupResource::collection($challenge_groups));
    }

    /**
     * @throws ChallengeGroupNotFoundException
     */
    public function update(UpdateChallengeGroupRequest $request, UpdateChallengeGroupUseCase $use_case): JsonResponse
    {
        $challenge_group = $use_case->execute((int) auth()->id(), $request->toDto());

        return (new ChallengeGroupResource($challenge_group))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * @throws ChallengeGroupNotFoundException
     */
    public function delete(int $id, DeleteChallengeGroupUseCase $use_case): JsonResponse
    {
        $use_case->execute((int) auth()->id(), $id);

        return response()->json()->setStatusCode(200);
    }
}
