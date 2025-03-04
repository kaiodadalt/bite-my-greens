<?php

declare(strict_types=1);

use App\Domain\Auth\Entities\UserEntity;
use App\Domain\Auth\Entities\UserEntityCollection;

it('creates a UserEntityCollection correctly', function () {
    $user_1 = new UserEntity(
        $id_1 = 1,
        'User name',
        'test@test.com',
    );

    $user_2 = new UserEntity(
        $id_2 = 2,
        'User name 2',
        'test2@test.com',
    );

    $collection = new UserEntityCollection($user_1, $user_2);
    expect($collection)->toBeInstanceOf(UserEntityCollection::class);

    $user_found = $collection->findById($id_1);
    expect($user_found)->toBe($user_1);

    $removed = $collection->removeById($id_2);
    expect($removed)->toBeTrue()
        ->and($collection->count())->toBe(1)
        ->and($collection->findById($id_2))->toBeNull();

    $removed = $collection->removeById($id_2);
    expect($removed)->toBeFalse()
        ->and($collection->contains($user_1))->toBeTrue()
        ->and($collection->contains($user_2))->toBeFalse();

    $copy = $collection->copy();
    expect($copy->count())->toBe(1);

    $copy->clear();
    expect($copy->count())->toBe(0);

    $is_empty = $collection->isEmpty();
    expect($is_empty)->toBeFalse();

    foreach ($collection as $key => $user) {
        expect($user)->toBeInstanceOf(UserEntity::class)
            ->and($key)->toBe($user->getId());
    }

    $array = $collection->toArray();
    expect($array)->toBeArray();

    $json = json_encode($collection);
    expect($json)->toBeString();
});
