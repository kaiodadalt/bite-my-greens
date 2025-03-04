<?php

declare(strict_types=1);

use App\Application\ChallengeGroups\UseCases\CreateChallengeGroupUseCase;
use App\Application\ChallengeGroups\UseCases\DeleteChallengeGroupUseCase;
use App\Application\ChallengeGroups\UseCases\GetChallengeGroupUseCase;
use App\Application\ChallengeGroups\UseCases\UpdateChallengeGroupUseCase;
use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFoundException;
use App\Infrastructure\Http\Controllers\ChallengeGroup\ChallengeGroupController;
use App\Infrastructure\Http\Requests\ChallengeGroup\CreateChallengeGroupRequest;
use App\Infrastructure\Http\Requests\ChallengeGroup\UpdateChallengeGroupRequest;
use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;

it('creates a challenge group successfully', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $request = new CreateChallengeGroupRequest([
        'name' => 'Group Name',
        'end_date' => now()->addMonth()->format('Y-m-d'),
    ]);
    $use_case = app(CreateChallengeGroupUseCase::class);

    $controller = new ChallengeGroupController();
    $response = $controller->create($request, $use_case);

    expect($response->getStatusCode())->toBe(201);
});

it('retrieves a challenge group successfully', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);
    $this->actingAs($user);

    $use_case = app(GetChallengeGroupUseCase::class);

    $controller = new ChallengeGroupController();
    $response = $controller->get($challenge_group->id, $use_case);

    expect($response->getStatusCode())->toBe(200);
});

it('throws exception when retrieving a non-existent challenge group', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $use_case = app(GetChallengeGroupUseCase::class);

    $controller = new ChallengeGroupController();
    $controller->get(99, $use_case);
})->throws(ChallengeGroupNotFoundException::class, 'Challenge group not found');

it('updates a challenge group successfully', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create(['created_by' => $user->id]);
    $this->actingAs($user);

    $data = [
        'name' => 'Updated Group Name',
        'end_date' => now()->addMonth()->format('Y-m-d'),
    ];

    $response = $this->putJson(route('challenge-group.update', ['id' => $challenge_group->id]), $data);

    $response->assertStatus(200);

    $this->assertDatabaseHas('challenge_groups', [
        'id' => $challenge_group->id,
        'name' => 'Updated Group Name',
        'end_date' => now()->addMonth()->startOfDay(),
    ]);
});

it('throws exception when updating a non-existent challenge group', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);
    $this->actingAs($user);

    $request = new UpdateChallengeGroupRequest([
        'name' => 'Group Name',
        'end_date' => now()->addMonth()->format('Y-m-d'),
    ]);
    $use_case = app(UpdateChallengeGroupUseCase::class);

    $controller = new ChallengeGroupController();
    $controller->update($request, $challenge_group->id, $use_case);
})->throws(ChallengeGroupNotFoundException::class, 'Challenge group not found');

it('deletes a challenge group successfully', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create(['created_by' => $user->id]);
    $this->actingAs($user);

    $response = $this->deleteJson(route('challenge-group.delete', ['id' => $challenge_group->id]));

    $response->assertStatus(200);

    $this->assertDatabaseMissing('challenge_groups', [
        'id' => $challenge_group->id,
    ]);
});

it('throws exception when deleting a non-existent challenge group', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $use_case = app(DeleteChallengeGroupUseCase::class);

    $controller = new ChallengeGroupController();
    $controller->delete(99, $use_case);
})->throws(ChallengeGroupNotFoundException::class, 'Challenge group not found');

it('retrieves a challenge group successfully with users', function () {
    $user = User::factory()->create();
    $another_user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);
    $challenge_group->participants()->attach($user->id);
    $challenge_group->participants()->attach($another_user->id);

    $this->actingAs($user);
    $response = $this->get(route('challenge-group.get', ['id' => $challenge_group->id]));

    expect($response->getStatusCode())->toBe(200);
});
