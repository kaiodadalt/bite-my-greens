<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;

it('creates a ChallengeGroupEntity correctly', function () {
    $entity = new ChallengeGroupEntity(
        $id = 1,
        $name = 'Challenge group',
        $end_date = now()->addMonth()->toDateTimeImmutable(),
        $created_by = 1,
        $created_at = now()->toDateTimeImmutable(),
        $updated_at = now()->toDateTimeImmutable()
    );

    expect($entity->getId())->toBe($id)
        ->and($entity->getOwnerId())->toBe($created_by)
        ->and($entity->getName())->toBe($name)
        ->and($entity->getEndDate())->toBe($end_date)
        ->and($entity->getCreatedAt())->toBe($created_at)
        ->and($entity->getUpdatedAt())->toBe($updated_at);
});
