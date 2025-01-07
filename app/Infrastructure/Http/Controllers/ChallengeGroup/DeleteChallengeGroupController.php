<?php

namespace App\Infrastructure\Http\Controllers\ChallengeGroup;

use App\Application\ChallengeGroups\DTOs\DeleteChallengeGroupDTO;
use App\Application\ChallengeGroups\UseCases\DeleteChallengeGroupUseCase;
use App\Infrastructure\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DeleteChallengeGroupController extends Controller
{
    public function __construct(
        private readonly DeleteChallengeGroupUseCase $delete
    ) {}

    public function get(int $id): JsonResponse
    {
        $this->delete->execute(
            auth()->user()->toDTO(),
            new DeleteChallengeGroupDTO($id)
        );
        return response()->json()->setStatusCode(200);
    }
}
