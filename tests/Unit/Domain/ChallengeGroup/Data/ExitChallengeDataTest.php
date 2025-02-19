<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Data\ExitChallengeData;

it('creates an ExitChallengeData correctly', function () {
    $data = new ExitChallengeData(
        $challenge_group_id = 1,
        $user_id = 1
    );

    expect($data->getChallengeGroupId())->toBe($challenge_group_id)
        ->and($data->getUserId())->toBe($user_id);
});
