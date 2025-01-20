<?php

declare(strict_types=1);

use App\Infrastructure\Http\Middleware\EnsureEmailIsVerified;
use App\Infrastructure\Persistence\Models\Auth\User;
use Illuminate\Http\Request;

it('allows request when email is verified', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $request = Mockery::mock(Request::class)->makePartial();
    $request->shouldReceive('user')->andReturn($user);

    $middleware = new EnsureEmailIsVerified();
    $response = $middleware->handle($request, fn ($req) => response()->json(['message' => 'Success'], 200));

    expect($response->getStatusCode())->toBe(200)
        ->and($response->getData()->message)->toBe('Success');
});

it('blocks request when email is not verified', function () {
    $user = User::factory()->create(['email_verified_at' => null]);
    $request = Mockery::mock(Request::class)->makePartial();
    $request->shouldReceive('user')->andReturn($user);

    $middleware = new EnsureEmailIsVerified();
    $response = $middleware->handle($request, fn ($req) => response()->json(['message' => 'Your email address is not verified.'], 409));

    expect($response->getStatusCode())->toBe(409)
        ->and($response->getData()->message)->toBe('Your email address is not verified.');
});

it('blocks request when user is not authenticated', function () {
    $request = Mockery::mock(Request::class)->makePartial();
    $request->shouldReceive('user')->andReturn(null);

    $middleware = new EnsureEmailIsVerified();
    $response = $middleware->handle($request, fn ($req) => response()->json(['message' => 'Success'], 200));

    expect($response->getStatusCode())->toBe(409)
        ->and($response->getData()->message)->toBe('Your email address is not verified.');
});
