<?php

declare(strict_types=1);

use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;

it('creates a ChallengeGroup correctly', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create(['created_by' => $user->id]);
    expect($challenge_group->creator->id)->toBe($user->id);
});
