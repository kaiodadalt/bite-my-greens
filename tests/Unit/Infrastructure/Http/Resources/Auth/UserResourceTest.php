<?php

declare(strict_types=1);

use App\Infrastructure\Http\Resources\Auth\UserResource;
use App\Infrastructure\Persistence\Models\Auth\User;

it('creates an UserResource correctly', function () {
    $user = User::factory()->create();
    $user_resource = new UserResource($user);

    expect($user_resource->toArray(request()))->toBe([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'created_at' => $user->created_at->format('Y-m-d H:i:s'),
    ]);
});
