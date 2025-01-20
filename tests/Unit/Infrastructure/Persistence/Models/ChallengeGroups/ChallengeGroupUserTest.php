<?php

declare(strict_types=1);

use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupUser;

it('creates a ChallengeGroupUser correctly', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create(['created_by' => $user->id]);
    $challenge_group_user = ChallengeGroupUser::factory()->create([
        'user_id' => $user->id,
        'challenge_group_id' => $challenge_group->id,
    ]);
    expect($challenge_group_user->user->id)->toBe($user->id)
        ->and($challenge_group_user->challengeGroup->id)->toBe($challenge_group->id);
});
