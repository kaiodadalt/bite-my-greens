<?php

declare(strict_types=1);

use App\Domain\Auth\Entities\UserEntity;
use App\Domain\Auth\Entities\UserEntityCollection;

beforeEach(fn () => $this->collection = new UserEntityCollection());

it('starts empty', function () {
    expect($this->collection->count())->toBe(0)
        ->and($this->collection->isEmpty())->toBeTrue();
});

it('can add and retrieve items', function () {
    $this->collection->addUser($user1 = new UserEntity(1, 'Item 1', 'test@test.com'));
    $this->collection->addUser($user2 = new UserEntity(2, 'Item 1', 'test@test.com'));

    expect($this->collection->count())->toBe(2)
        ->and($this->collection->contains($user1))->toBeTrue()
        ->and($this->collection->contains($user2))->toBeTrue()
        ->and($this->collection->all()->get(1))->toBe($user1)
        ->and($this->collection->all()->get(2))->toBe($user2);
});

it('can convert to array', function () {
    $this->collection->addUser($user1 = new UserEntity(1, 'Item 1', 'test@test.com'));
    $this->collection->addUser($user2 = new UserEntity(2, 'Item 1', 'test@test.com'));

    expect($this->collection->toArray())->toBe([$user1, $user2]);
});

it('can clear items', function () {
    $this->collection->addUser(new UserEntity(1, 'Item 1', 'test@test.com'));
    $this->collection->clear();

    expect($this->collection->count())->toBe(0)
        ->and($this->collection->isEmpty())->toBeTrue();
});

it('can clone itself', function () {
    $this->collection->addUser(new UserEntity(1, 'Item 1', 'test@test.com'));

    $clone = $this->collection->copy();

    expect($clone->toArray())->toBe($this->collection->toArray());
});

it('can be iterated', function () {
    $this->collection->addUser($user1 = new UserEntity(1, 'Item 1', 'test@test.com'));
    $this->collection->addUser($user2 = new UserEntity(2, 'Item 1', 'test@test.com'));

    $items = [];
    foreach ($this->collection as $key => $value) {
        $items[$key] = $value;
    }

    expect($items)->toBe([
        1 => $user1,
        2 => $user2,
    ]);
});

it('throws an exception if copy() fails', function () {
    $collection = new UserEntityCollection();
    $mock = Mockery::mock($collection)->makePartial();
    $mock->shouldReceive('copy')->andThrow(ReflectionException::class);

    $this->expectException(ReflectionException::class);
    $mock->copy();
});

it('can be converted to JSON', function () {
    $this->collection->addUser($user1 = new UserEntity(1, 'Item 1', 'test@test.com'));
    $this->collection->addUser($user2 = new UserEntity(2, 'Item 2', 'test@test.com'));

    expect(json_encode($this->collection))->toBe(json_encode([$user1, $user2]));
});

it('returns a valid iterator', function () {
    $this->collection->addUser($user1 = new UserEntity(1, 'Item 1', 'test@test.com'));
    $this->collection->addUser($user2 = new UserEntity(2, 'Item 2', 'test@test.com'));

    $iterator = $this->collection->getIterator();

    expect($iterator)->toBeInstanceOf(ArrayIterator::class)
        ->and(iterator_to_array($iterator))->toBe([
            1 => $user1,
            2 => $user2,
        ]);
});

it('can add an item with a specific key', function () {
    $reflection = new ReflectionClass($this->collection);
    $method = $reflection->getMethod('addWithKey');
    $method->setAccessible(true);

    $user = new UserEntity(42, 'Special User', 'special@test.com');
    $method->invoke($this->collection, 42, $user);

    expect($this->collection->all()->get(42))->toBe($user);
});

it('serializes an empty collection to JSON', function () {
    expect(json_encode($this->collection))->toBe(json_encode([]));
});
