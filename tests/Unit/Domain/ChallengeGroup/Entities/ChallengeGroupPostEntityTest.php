<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Entities\ChallengeGroupPostEntity;

it('creates a ChallengeGroupPostEntity correctly', function () {
    $entity = new ChallengeGroupPostEntity(
        $challenge_group_id = 1,
        $user_id = 1,
        $description = 'Description',
        $image = 'image.jpg',
        $score = 100,
        $created_at = now()->toDateTimeImmutable(),
        $updated_at = now()->toDateTimeImmutable()
    );

    expect($entity->getChallengeGroupId())->toBe($challenge_group_id)
        ->and($entity->getUserId())->toBe($user_id)
        ->and($entity->getDescription())->toBe($description)
        ->and($entity->getImage())->toBe($image)
        ->and($entity->getScore())->toBe($score)
        ->and($entity->getCreatedAt())->toBe($created_at)
        ->and($entity->getUpdatedAt())->toBe($updated_at);
});
