<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Data\CreateChallengeGroupData;
use App\Domain\ChallengeGroup\Data\UpdateChallengeGroupData;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\Shared\Exceptions\DomainException;
use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;
use App\Infrastructure\Persistence\Repositories\ChallengeGroup\ChallengeGroupEloquentRepository;

it('creates a new challenge group', function () {
    $user = User::factory()->create();

    $repository = new ChallengeGroupEloquentRepository();
    $data = new CreateChallengeGroupData(
        name: 'Test Challenge Group',
        end_date: new DateTimeImmutable('2025-01-31'),
        created_by: $user->id
    );

    $entity = $repository->create($data);

    expect($entity)
        ->toBeInstanceOf(ChallengeGroupEntity::class)
        ->and($entity->getName())->toBe('Test Challenge Group')
        ->and($entity->getOwnerId())->toBe($user->id);
});

it('updates an existing challenge group', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create(['created_by' => $user->id]);

    $repository = new ChallengeGroupEloquentRepository();
    $data = new UpdateChallengeGroupData(
        id: $challenge_group->id,
        created_by: $user->id,
        name: 'Updated Challenge Group',
        end_date: new DateTimeImmutable('2025-02-28')
    );

    $entity = $repository->update($data);

    expect($entity)
        ->toBeInstanceOf(ChallengeGroupEntity::class)
        ->and($entity->getName())->toBe('Updated Challenge Group')
        ->and($entity->getEndDate()->format('Y-m-d'))->toBe('2025-02-28');
});

it('updates a challenge group name only', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create(['created_by' => $user->id]);

    $repository = new ChallengeGroupEloquentRepository();
    $data = new UpdateChallengeGroupData(
        id: $challenge_group->id,
        created_by: $user->id,
        name: 'Updated Name',
    );

    $entity = $repository->update($data);

    expect($entity)
        ->toBeInstanceOf(ChallengeGroupEntity::class)
        ->and($entity->getName())->toBe('Updated Name');
});

it('updates a challenge group end date only', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create(['created_by' => $user->id]);

    $repository = new ChallengeGroupEloquentRepository();
    $data = new UpdateChallengeGroupData(
        id: $challenge_group->id,
        created_by: $user->id,
        name: null,
        end_date: new DateTimeImmutable('2025-03-01')
    );

    $entity = $repository->update($data);

    expect($entity)
        ->toBeInstanceOf(ChallengeGroupEntity::class)
        ->and($entity->getEndDate()->format('Y-m-d'))->toBe('2025-03-01')
        ->and($entity->getName())->toBe($challenge_group->name);
});

it('throws exception when updating a non-existing challenge group', function () {
    $repository = new ChallengeGroupEloquentRepository();
    $data = new UpdateChallengeGroupData(
        id: 999,
        created_by: 1,
        name: 'Non-existing Challenge Group',
        end_date: new DateTimeImmutable('2025-02-28')
    );

    $repository->update($data);
})->throws(DomainException::class, 'Challenge group does not exist');

it('deletes an existing challenge group', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create(['created_by' => $user->id]);

    $repository = new ChallengeGroupEloquentRepository();
    $entity = new ChallengeGroupEntity(
        id: $challenge_group->id,
        name: $challenge_group->name,
        end_date: $challenge_group->end_date,
        created_by: $user->id,
        created_at: $challenge_group->created_at,
        updated_at: $challenge_group->updated_at,
    );

    $deleted = $repository->delete($entity);

    expect($deleted)->toBeTrue()
        ->and(ChallengeGroup::find($entity->getId()))->toBeNull();
});

it('finds a challenge group by ID', function () {
    $challenge_group = ChallengeGroup::factory()->create();

    $repository = new ChallengeGroupEloquentRepository();
    $entity = $repository->find($challenge_group->id);

    expect($entity)
        ->toBeInstanceOf(ChallengeGroupEntity::class)
        ->and($entity->getId())->toBe($challenge_group->id)
        ->and($entity->getName())->toBe($challenge_group->name);
});

it('returns null when finding a non-existing challenge group', function () {
    $repository = new ChallengeGroupEloquentRepository();

    $entity = $repository->find(999);

    expect($entity)->toBeNull();
});

it('checks if a user is a member of a challenge group', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create();
    $challenge_group->participants()->attach($user->id);

    $repository = new ChallengeGroupEloquentRepository();
    $entity = new ChallengeGroupEntity(
        id: $challenge_group->id,
        name: $challenge_group->name,
        end_date: $challenge_group->end_date,
        created_by: $challenge_group->created_by,
        created_at: $challenge_group->created_at,
        updated_at: $challenge_group->updated_at,
    );

    $is_member = $repository->hasMember($entity, $user->id);

    expect($is_member)->toBeTrue();
});

it('returns false when a user is not a member of a challenge group', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create();

    $repository = new ChallengeGroupEloquentRepository();
    $entity = new ChallengeGroupEntity(
        id: $challenge_group->id,
        name: $challenge_group->name,
        end_date: $challenge_group->end_date,
        created_by: $challenge_group->created_by,
        created_at: $challenge_group->created_at,
        updated_at: $challenge_group->updated_at,
    );

    $is_member = $repository->hasMember($entity, $user->id);

    expect($is_member)->toBeFalse();
});

it('finds a challenge group with findOrFail', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create(['created_by' => $user->id]);

    $repository = new ChallengeGroupEloquentRepository();
    $entity = $repository->findOrFail($challenge_group->id, $user->id);

    expect($entity)
        ->toBeInstanceOf(ChallengeGroupEntity::class)
        ->and($entity->getId())->toBe($challenge_group->id)
        ->and($entity->getOwnerId())->toBe($user->id);
});

it('throws exception when finding a non-existing challenge group with findOrFail', function () {
    $repository = new ChallengeGroupEloquentRepository();

    $repository->findOrFail(999, 1);
})->throws(DomainException::class, 'Challenge group does not exist');
