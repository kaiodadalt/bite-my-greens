<?php

declare(strict_types=1);

use App\Domain\Auth\Entities\UserEntityCollection;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Infrastructure\Persistence\Mappers\UserMapper;
use App\Infrastructure\Persistence\Models\Auth\User;

it('creates a ChallengeGroupEntity correctly', function () {
    $user = User::factory()->create();
    $entity = new ChallengeGroupEntity(
        $id = 1,
        $name = 'Challenge group',
        $end_date = now()->addMonth()->toDateTimeImmutable(),
        $owner = UserMapper::map($user),
        $participants = new UserEntityCollection(),
        $created_at = now()->toDateTimeImmutable(),
        $updated_at = now()->toDateTimeImmutable()
    );

    expect($entity->getId())->toBe($id)
        ->and($entity->getOwner())->toBe($owner)
        ->and($entity->getName())->toBe($name)
        ->and($entity->getParticipants())->toBe($participants)
        ->and($entity->getEndDate())->toBe($end_date)
        ->and($entity->getCreatedAt())->toBe($created_at)
        ->and($entity->getUpdatedAt())->toBe($updated_at);
});
