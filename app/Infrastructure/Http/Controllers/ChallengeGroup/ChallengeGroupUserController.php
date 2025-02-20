<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controllers\ChallengeGroup;

use App\Application\ChallengeGroups\Contracts\ParticipantAction;
use App\Application\ChallengeGroups\UseCases\ExitChallengeGroupUseCase;
use App\Application\ChallengeGroups\UseCases\JoinChallengeGroupUseCase;
use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFoundException;
use App\Infrastructure\Http\Controllers\Controller;
use App\Infrastructure\Http\Requests\ChallengeGroup\ExitChallengeGroupRequest;
use App\Infrastructure\Http\Requests\ChallengeGroup\JoinChallengeGroupRequest;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;

final class ChallengeGroupUserController extends Controller
{
    /**
     * @throws ChallengeGroupNotFoundException
     */
    public function join(JoinChallengeGroupRequest $request, JoinChallengeGroupUseCase $use_case): Response
    {
        $this->handleParticipantAction($use_case, $request->challenge_code);

        return response(status: 200);
    }

    /**
     * @throws ChallengeGroupNotFoundException
     */
    public function exit(ExitChallengeGroupRequest $request, ExitChallengeGroupUseCase $use_case): Response
    {
        $this->handleParticipantAction($use_case, $request->challenge_code);

        return response(status: 200);
    }

    /**
     * @throws ChallengeGroupNotFoundException
     */
    private function handleParticipantAction(ParticipantAction $use_case, string $challenge_code): void
    {
        try {
            $challenge_group_id = (int) Crypt::decryptString($challenge_code);
            $use_case->execute((int) auth()->id(), $challenge_group_id);
        } catch (Exception) {
            throw new ChallengeGroupNotFoundException();
        }
    }
}
