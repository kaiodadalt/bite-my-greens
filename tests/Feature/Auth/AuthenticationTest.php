<?php

declare(strict_types=1);

use App\Infrastructure\Persistence\Models\Auth\User;
use Illuminate\Support\Facades\Auth;

it('allows users to authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    expect(Auth::check())->toBeTrue();
    $response->assertNoContent();
})->group('auth', 'login');

it('does not allow users to authenticate with an invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    expect(Auth::check())->toBeFalse();
})->group('auth', 'login');

it('allows users to logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    expect(Auth::check())->toBeFalse();
    $response->assertNoContent();
})->group('auth', 'logout');
