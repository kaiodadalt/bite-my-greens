<?php

declare(strict_types=1);

use App\Application\ChallengeGroups\DTO\AddChallengeGroupPostDTO;
use App\Application\ChallengeGroups\UseCases\AddChallengeGroupPostUseCase;
use App\Application\ChallengeGroups\UseCases\DeleteChallengeGroupUseCase;
use App\Application\Shared\Factory\FileFactory;
use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFoundException;
use App\Domain\ChallengeGroup\Exceptions\UserNotAllowedToPostException;
use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupUser;
use Illuminate\Http\UploadedFile;

it('deletes a Challenge Group using UseCase', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create();
    $use_case = app(DeleteChallengeGroupUseCase::class);
    $deleted = $use_case->execute($user->id, $challenge_group->id);
    expect($deleted)->toBeTrue();
});

it('throws exception when user is not allowed to post', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);
    ChallengeGroupUser::factory()->create([
        'user_id' => $user->id,
        'challenge_group_id' => $challenge_group->id,
    ]);
    $use_case = app(AddChallengeGroupPostUseCase::class);
    $not_allowed_user = User::factory()->create();

    $use_case->execute($not_allowed_user->id, new AddChallengeGroupPostDTO(
        $challenge_group->id,
        'This is a challenge post',
        FileFactory::fromUploadedFile(UploadedFile::fake()->image('image.jpg')),
    ));
})->throws(UserNotAllowedToPostException::class, 'You are not allowed to post in this challenge group');

it('throws exception when challenge group is not found', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);
    ChallengeGroupUser::factory()->create([
        'user_id' => $user->id,
        'challenge_group_id' => $challenge_group->id,
    ]);
    $use_case = app(AddChallengeGroupPostUseCase::class);

    $use_case->execute($user->id, new AddChallengeGroupPostDTO(
        99,
        'This is a challenge post',
        FileFactory::fromUploadedFile(UploadedFile::fake()->image('image.jpg')),
    ));
})->throws(ChallengeGroupNotFoundException::class, 'Challenge group not found');
