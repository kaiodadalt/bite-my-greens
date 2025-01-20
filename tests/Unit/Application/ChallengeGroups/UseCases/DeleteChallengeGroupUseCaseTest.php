<?php

declare(strict_types=1);

use App\Application\ChallengeGroups\UseCases\DeleteChallengeGroupUseCase;
use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;

it('deletes a Challenge Group using UseCase', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create();
    $use_case = app(DeleteChallengeGroupUseCase::class);
    $deleted = $use_case->execute($user->id, $challenge_group->id);
    expect($deleted)->toBeTrue();
});
