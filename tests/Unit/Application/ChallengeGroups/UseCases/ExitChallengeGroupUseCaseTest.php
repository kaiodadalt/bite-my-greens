<?php

declare(strict_types=1);

use App\Application\ChallengeGroups\UseCases\ExitChallengeGroupUseCase;
use App\Application\ChallengeGroups\UseCases\JoinChallengeGroupUseCase;
use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;

it('exit a Challenge Group using UseCase', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create();

    $join_use_case = app(JoinChallengeGroupUseCase::class);
    $join_use_case->execute($user->id, $challenge_group->id);

    $exit_use_case = app(ExitChallengeGroupUseCase::class);
    $exit_use_case->execute($user->id, $challenge_group->id);

    $this->assertDatabaseMissing('challenge_groups_users', [
        'user_id' => $user->id,
        'challenge_group_id' => $challenge_group->id,
    ]);
});
