<?php

declare(strict_types=1);

use App\Domain\Auth\Entities\UserEntityCollection;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupPostEntityCollection;
use App\Domain\ChallengeGroup\Services\AuthorizeChallengeGroupService;
use App\Infrastructure\Persistence\Mappers\UserMapper;
use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupUser;

it('allows viewing when user is the owner', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);

    $service = app(AuthorizeChallengeGroupService::class);

    expect($service->canView($user->id, new ChallengeGroupEntity(
        $challenge_group->id,
        $challenge_group->name,
        $challenge_group->end_date,
        UserMapper::map($user),
        new UserEntityCollection(),
        new ChallengeGroupPostEntityCollection(),
        $challenge_group->created_at,
        $challenge_group->updated_at
    )))->toBeTrue();
});

it('allows viewing when user is a member', function () {
    $owner = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $owner->id,
    ]);
    $member = User::factory()->create();
    ChallengeGroupUser::factory()->create([
        'challenge_group_id' => $challenge_group->id,
        'user_id' => $member->id,
    ]);

    $service = app(AuthorizeChallengeGroupService::class);

    expect($service->canView($member->id, new ChallengeGroupEntity(
        $challenge_group->id,
        $challenge_group->name,
        $challenge_group->end_date,
        UserMapper::map($owner),
        new UserEntityCollection(),
        new ChallengeGroupPostEntityCollection(),
        $challenge_group->created_at,
        $challenge_group->updated_at
    )))->toBeTrue();
});

it('denies viewing when user is neither owner nor member', function () {
    $user_1 = User::factory()->create();
    $user_2 = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user_1->id,
    ]);

    $service = app(AuthorizeChallengeGroupService::class);

    expect($service->cannotView($user_2->id, new ChallengeGroupEntity(
        $challenge_group->id,
        $challenge_group->name,
        $challenge_group->end_date,
        UserMapper::map($user_1),
        new UserEntityCollection(),
        new ChallengeGroupPostEntityCollection(),
        $challenge_group->created_at,
        $challenge_group->updated_at
    )))->toBeTrue();
});

it('allows updating when user is the owner', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);

    $service = app(AuthorizeChallengeGroupService::class);

    expect($service->cannotUpdate($user->id, new ChallengeGroupEntity(
        $challenge_group->id,
        $challenge_group->name,
        $challenge_group->end_date,
        UserMapper::map($user),
        new UserEntityCollection(),
        new ChallengeGroupPostEntityCollection(),
        $challenge_group->created_at,
        $challenge_group->updated_at
    )))->toBeFalse();
});

it('denies deleting when user is not the owner', function () {
    $user_1 = User::factory()->create();
    $user_2 = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user_1->id,
    ]);

    $service = app(AuthorizeChallengeGroupService::class);

    expect($service->cannotDelete($user_2->id, new ChallengeGroupEntity(
        $challenge_group->id,
        $challenge_group->name,
        $challenge_group->end_date,
        UserMapper::map($user_1),
        new UserEntityCollection(),
        new ChallengeGroupPostEntityCollection(),
        $challenge_group->created_at,
        $challenge_group->updated_at
    )))->toBeTrue();
});

it('allows deleting when user is the owner', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);

    $service = app(AuthorizeChallengeGroupService::class);

    expect($service->cannotDelete($user->id, new ChallengeGroupEntity(
        $challenge_group->id,
        $challenge_group->name,
        $challenge_group->end_date,
        UserMapper::map($user),
        new UserEntityCollection(),
        new ChallengeGroupPostEntityCollection(),
        $challenge_group->created_at,
        $challenge_group->updated_at
    )))->toBeFalse();
});
