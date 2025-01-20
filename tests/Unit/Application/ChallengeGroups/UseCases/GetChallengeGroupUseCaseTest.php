<?php

declare(strict_types=1);

use App\Application\ChallengeGroups\UseCases\GetChallengeGroupUseCase;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;

it('gets a Challenge Group using UseCase', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create();
    $use_case = app(GetChallengeGroupUseCase::class);
    $challenge_group_entity = $use_case->execute($user->id, $challenge_group->id);
    expect($challenge_group_entity)->toBeInstanceOf(ChallengeGroupEntity::class)
        ->and($challenge_group_entity->getId())->toBe($challenge_group->id)
        ->and($challenge_group_entity->getOwnerId())->toBe($user->id);
});
