<?php

declare(strict_types=1);

use App\Application\ChallengeGroups\UseCases\ExitChallengeGroupUseCase;
use App\Application\ChallengeGroups\UseCases\JoinChallengeGroupUseCase;
use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFoundException;
use App\Infrastructure\Http\Controllers\ChallengeGroup\ChallengeGroupUserController;
use App\Infrastructure\Http\Requests\ChallengeGroup\ExitChallengeGroupRequest;
use App\Infrastructure\Http\Requests\ChallengeGroup\JoinChallengeGroupRequest;
use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;
use Illuminate\Support\Facades\Crypt;

it('joins a challenge group successfully', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create();
    $this->actingAs($user);
    $challenge_code = Crypt::encryptString((string) $challenge_group->id);

    $request = new JoinChallengeGroupRequest(['challenge_code' => $challenge_code]);
    $use_case = app(JoinChallengeGroupUseCase::class);

    $controller = new ChallengeGroupUserController();
    $response = $controller->join($request, $use_case);
    $this->assertDatabaseHas('challenge_groups_users', [
        'user_id' => $user->id,
        'challenge_group_id' => $challenge_group->id,
    ]);

    expect($response->getStatusCode())->toBe(200);
});

it('exits a challenge group successfully', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create();
    $this->actingAs($user);
    $challenge_code = Crypt::encryptString((string) $challenge_group->id);

    $controller = new ChallengeGroupUserController();

    $join_use_case = app(JoinChallengeGroupUseCase::class);
    $controller->join(new JoinChallengeGroupRequest(['challenge_code' => $challenge_code]), $join_use_case);

    $exit_use_case = app(ExitChallengeGroupUseCase::class);
    $response = $controller->exit(new ExitChallengeGroupRequest(['challenge_code' => $challenge_code]), $exit_use_case);
    $this->assertDatabaseMissing('challenge_groups_users', [
        'user_id' => $user->id,
        'challenge_group_id' => $challenge_group->id,
    ]);
    expect($response->getStatusCode())->toBe(200);
});

it('throws ChallengeGroupNotFoundException when challenge code is invalid', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $invalid_challenge_code = 'invalid_code';

    $request = new JoinChallengeGroupRequest(['challenge_code' => $invalid_challenge_code]);
    $use_case = app(JoinChallengeGroupUseCase::class);

    $controller = new ChallengeGroupUserController();

    expect(fn () => $controller->join($request, $use_case))->toThrow(ChallengeGroupNotFoundException::class);
});

it('throws ChallengeGroupNotFoundException when challenge group does not exist', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $non_existent_challenge_group_id = 9999;
    $challenge_code = Crypt::encryptString((string) $non_existent_challenge_group_id);

    $request = new JoinChallengeGroupRequest(['challenge_code' => $challenge_code]);
    $use_case = app(JoinChallengeGroupUseCase::class);

    $controller = new ChallengeGroupUserController();

    expect(fn () => $controller->join($request, $use_case))->toThrow(ChallengeGroupNotFoundException::class);
});
