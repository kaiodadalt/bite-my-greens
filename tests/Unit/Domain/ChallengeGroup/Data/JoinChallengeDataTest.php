<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Data\JoinChallengeData;

it('creates a JoinChallengeData correctly', function () {
    $data = new JoinChallengeData(
        $challenge_group_id = 1,
        $user_id = 1
    );

    expect($data->getChallengeGroupId())->toBe($challenge_group_id)
        ->and($data->getUserId())->toBe($user_id);
});
