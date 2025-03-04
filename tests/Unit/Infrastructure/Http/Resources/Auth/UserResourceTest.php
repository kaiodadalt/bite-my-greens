<?php

declare(strict_types=1);

use App\Infrastructure\Http\Resources\Auth\UserResource;
use App\Infrastructure\Persistence\Mappers\UserMapper;
use App\Infrastructure\Persistence\Models\Auth\User;

it('creates an UserResource correctly', function () {
    $user = User::factory()->create();
    $user_resource = new UserResource(UserMapper::map($user));

    expect($user_resource->toArray(request()))->toBe([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
    ]);
});
