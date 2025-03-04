<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Data\CreateChallengeGroupData;
use App\Domain\ChallengeGroup\Data\UpdateChallengeGroupData;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFoundException;
use App\Domain\ChallengeGroup\Services\ChallengeGroupService;
use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;

it('creates a challenge group successfully', function () {
    $user = User::factory()->create();
    $service = app(ChallengeGroupService::class);

    $entity = $service->create(new CreateChallengeGroupData(
        $name = 'Group Name',
        $end_date = now()->addDays(7)->toDateTimeImmutable(),
        $user->id
    ));

    expect($entity)->toBeInstanceOf(ChallengeGroupEntity::class)
        ->and($entity->getName())->toBe($name)
        ->and($entity->getEndDate()->format('Y-m-d'))->toBe($end_date->format('Y-m-d'))
        ->and($entity->getOwner()->getId())->toBe($user->id);
});

it('retrieves a challenge group successfully', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);
    $service = app(ChallengeGroupService::class);

    $entity = $service->get($user->id, $challenge_group->id);

    expect($entity)->toBeInstanceOf(ChallengeGroupEntity::class)
        ->and($entity->getId())->toBe($challenge_group->id)
        ->and($entity->getOwner()->getId())->toBe($user->id);
});

it('throws exception when retrieving a non-existent challenge group', function () {
    $service = app(ChallengeGroupService::class);
    $service->get(99, 99);
})->throws(ChallengeGroupNotFoundException::class, 'Challenge group not found');

it('updates a challenge group successfully', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);
    $service = app(ChallengeGroupService::class);

    $entity = $service->update(new UpdateChallengeGroupData(
        $challenge_group->id,
        $user->id,
        $name = 'Updated Group Name',
        $end_date = now()->addDays(7)->toDateTimeImmutable(),
    ));

    expect($entity)->toBeInstanceOf(ChallengeGroupEntity::class)
        ->and($entity->getName())->toBe($name)
        ->and($entity->getEndDate()->format('Y-m-d'))->toBe($end_date->format('Y-m-d'));
});

it('throws exception when updating a non-existent challenge group', function () {
    $service = app(ChallengeGroupService::class);
    $service->update(new UpdateChallengeGroupData(
        99,
        99,
        'Updated Group Name',
        now()->addDays(7)->toDateTimeImmutable(),
    ));
})->throws(ChallengeGroupNotFoundException::class, 'Challenge group not found');

it('deletes a challenge group successfully', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);
    $service = app(ChallengeGroupService::class);

    $result = $service->delete($user->id, $challenge_group->id);

    expect($result)->toBeTrue();
});

it('throws exception when deleting a non-existent challenge group', function () {
    $service = app(ChallengeGroupService::class);
    $service->delete(99, 99);
})->throws(ChallengeGroupNotFoundException::class, 'Challenge group not found');
