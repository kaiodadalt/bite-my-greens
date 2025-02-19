<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Data\ExitChallengeData;
use App\Domain\ChallengeGroup\Data\JoinChallengeData;
use App\Domain\Shared\Exceptions\DomainException;
use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupUser;
use App\Infrastructure\Persistence\Repositories\ChallengeGroup\ChallengeGroupUserEloquentRepository;

it('throws exception if user is already in the challenge, when trying to join a challenge', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);
    ChallengeGroupUser::factory()->create([
        'challenge_group_id' => $challenge_group->id,
        'user_id' => $user->id,
    ]);
    $repository = new ChallengeGroupUserEloquentRepository();

    $repository->joinChallenge(new JoinChallengeData(
        $challenge_group->id,
        $user->id,
    ));
})->throws(DomainException::class, 'User already joined the challenge');

it('throws exception if user is not in the challenge, when trying to exit the challenge', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);
    $repository = new ChallengeGroupUserEloquentRepository();

    $repository->exitChallenge(new ExitChallengeData(
        $challenge_group->id,
        $user->id,
    ));
})->throws(DomainException::class, 'User is not part of the challenge');
