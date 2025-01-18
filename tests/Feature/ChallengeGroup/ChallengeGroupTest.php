<?php

declare(strict_types=1);

use App\Infrastructure\Persistence\Models\Auth\User;

it('allows an authenticated user to create a challenge group', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    expect(auth()->check())->toBeTrue();

    $response = $this->post('/api/challenge-group', [
        'name' => 'Kaio Challenge',
        'end_date' => now()->addDays(7)->toDateString(),
    ]);

    $response->assertStatus(201);
    $response->assertJson([
        'name' => 'Kaio Challenge',
        'end_date' => now()->addDays(7)->toDateString(),
    ]);
})->group('challenge-group');

it('allows an authenticated user to update a challenge group', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    expect(auth()->check())->toBeTrue();

    $response = $this->post('/api/challenge-group', [
        'name' => 'Kaio Challenge',
        'end_date' => now()->addDays(7)->toDateString(),
    ]);

    $id = $response->json('id');

    $response = $this->put('/api/challenge-group/'.$id, [
        'name' => 'Updated Challenge',
        'end_date' => now()->addDays(10)->toDateString(),
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'id' => $id,
        'name' => 'Updated Challenge',
        'end_date' => now()->addDays(10)->toDateString(),
    ]);

    $this->assertDatabaseHas('challenge_groups', [
        'id' => $id,
        'name' => 'Updated Challenge',
        'end_date' => now()->startOfDay()->addDays(10)->format('Y-m-d H:i:s'),
    ]);
})->group('challenge-group');
