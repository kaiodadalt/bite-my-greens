<?php

declare(strict_types=1);

use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupPost;

it('creates a ChallengeGroupPost correctly', function () {
    $challenge_group_post = ChallengeGroupPost::factory()->create([
        'description' => 'This is a challenge post',
    ]);
    expect($challenge_group_post->user->id)->toBe(1)
        ->and($challenge_group_post->challengeGroup->id)->toBe(1)
        ->and($challenge_group_post->user->id)->toBe(1)
        ->and($challenge_group_post->description)->toBe('This is a challenge post');
});
