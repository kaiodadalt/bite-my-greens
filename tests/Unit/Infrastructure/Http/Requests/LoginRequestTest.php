<?php

declare(strict_types=1);

use App\Infrastructure\Http\Requests\Auth\LoginRequest;
use App\Infrastructure\Persistence\Models\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

it('authorizes the login request', function () {
    $request = new LoginRequest();
    expect($request->authorize())->toBeTrue();
});

it('validates the login request with valid data', function () {
    $request = new LoginRequest();
    $validator = Validator::make([
        'email' => 'test@example.com',
        'password' => 'password123',
    ], $request->rules());

    expect($validator->passes())->toBeTrue();
});

it('fails validation with missing email', function () {
    $request = new LoginRequest();
    $validator = Validator::make([
        'password' => 'password123',
    ], $request->rules());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('email'))->toBeTrue();
});

it('fails validation with missing password', function () {
    $request = new LoginRequest();
    $validator = Validator::make([
        'email' => 'test@example.com',
    ], $request->rules());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('password'))->toBeTrue();
});

it('authenticates with valid credentials', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
    ]);

    $request = new LoginRequest();
    $request->merge([
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $request->authenticate();
    expect(Auth::check())->toBeTrue();
});

it('throws validation exception with invalid credentials', function () {
    $request = new LoginRequest();
    $request->merge([
        'email' => 'test@example.com',
        'password' => 'wrongpassword',
    ]);

    expect(fn () => $request->authenticate())->toThrow(ValidationException::class);
});

it('ensures the login request is not rate limited', function () {
    $request = new LoginRequest();
    RateLimiter::shouldReceive('tooManyAttempts')->once()->andReturn(false);

    expect(fn () => $request->ensureIsNotRateLimited())->not->toThrow(ValidationException::class);
});

it('throws validation exception when rate limited', function () {
    $request = new LoginRequest();
    RateLimiter::shouldReceive('tooManyAttempts')->once()->andReturn(true);
    RateLimiter::shouldReceive('availableIn')->once()->andReturn(60);
    Event::shouldReceive('dispatch')->once();

    expect(fn () => $request->ensureIsNotRateLimited())->toThrow(ValidationException::class);
});
