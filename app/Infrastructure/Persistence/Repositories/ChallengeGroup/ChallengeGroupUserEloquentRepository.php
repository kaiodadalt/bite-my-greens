<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repositories\ChallengeGroup;

use App\Domain\ChallengeGroup\Contracts\ChallengeGroupUserRepository;
use App\Domain\ChallengeGroup\Data\ExitChallengeData;
use App\Domain\ChallengeGroup\Data\JoinChallengeData;
use App\Domain\Shared\Exceptions\DomainException;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupUser;

final class ChallengeGroupUserEloquentRepository implements ChallengeGroupUserRepository
{
    /**
     * @throws DomainException
     */
    public function joinChallenge(JoinChallengeData $data): void
    {
        if ($this->exists($data->getChallengeGroupId(), $data->getUserId())) {
            throw new DomainException('User already joined the challenge');
        }
        ChallengeGroupUser::create([
            'challenge_group_id' => $data->getChallengeGroupId(),
            'user_id' => $data->getUserId(),
        ]);
    }

    /**
     * @throws DomainException
     */
    public function exitChallenge(ExitChallengeData $data): void
    {
        if (! $this->exists($data->getChallengeGroupId(), $data->getUserId())) {
            throw new DomainException('User is not part of the challenge');
        }
        ChallengeGroupUser::where([
            'challenge_group_id' => $data->getChallengeGroupId(),
            'user_id' => $data->getUserId(),
        ])->delete();
    }

    private function exists(int $challenge_group_id, int $user_id): bool
    {
        return ChallengeGroupUser::where([
            'challenge_group_id' => $challenge_group_id,
            'user_id' => $user_id,
        ])->exists();
    }
}
