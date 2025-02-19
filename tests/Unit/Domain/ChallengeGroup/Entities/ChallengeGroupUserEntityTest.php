<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Entities\ChallengeGroupUserEntity;

it('creates a ChallengeGroupUserEntity correctly', function () {
    $entity = new ChallengeGroupUserEntity(
        $challenge_group_id = 1,
        $user_id = 1
    );

    expect($entity->getChallengeGroupId())->toBe($challenge_group_id)
        ->and($entity->getUserId())->toBe($user_id);
});
