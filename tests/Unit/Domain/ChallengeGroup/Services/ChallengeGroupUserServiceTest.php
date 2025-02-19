<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Data\ExitChallengeData;
use App\Domain\ChallengeGroup\Data\JoinChallengeData;
use App\Domain\ChallengeGroup\Services\ChallengeGroupUserService;
use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;

test('user join a challenge group successfully', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);

    $service = app(ChallengeGroupUserService::class);

    $service->joinChallenge(new JoinChallengeData(
        $challenge_group->id,
        $user->id,
    ));

    $this->assertDatabaseHas('challenge_groups_users', [
        'challenge_group_id' => $challenge_group->id,
        'user_id' => $user->id,
    ]);
});

test('user exit a challenge group successfully', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);

    $service = app(ChallengeGroupUserService::class);

    $service->joinChallenge(new JoinChallengeData(
        $challenge_group->id,
        $user->id,
    ));

    $service->exitChallenge(new ExitChallengeData(
        $challenge_group->id,
        $user->id,
    ));

    $this->assertDatabaseMissing('challenge_groups_users', [
        'challenge_group_id' => $challenge_group->id,
        'user_id' => $user->id,
    ]);
});
