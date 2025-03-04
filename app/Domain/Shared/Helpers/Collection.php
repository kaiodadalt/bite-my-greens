<?php

declare(strict_types=1);

namespace App\Domain\Shared\Helpers;

use ArrayIterator;
use Ds\Collection as BaseCollection;
use Ds\Map;
use ReflectionClass;
use ReflectionException;

/**
 * @template TKey of int|string
 * @template TValue
 *
 * @implements BaseCollection<TKey, TValue>
 */
abstract class Collection implements BaseCollection
{
    /** @var Map<TKey, TValue> */
    private readonly Map $items;

    protected function __construct()
    {
        $this->items = new Map();
    }

    /**
     * Returns all items.
     *
     * @return Map<TKey, TValue>
     */
    final public function all(): Map
    {
        return $this->items;
    }

    /**
     * Checks if a specific value exists in the collection.
     *
     * @param  TValue  $item
     */
    final public function contains(mixed $item): bool
    {
        return in_array($item, $this->items->values()->toArray(), true);
    }

    /**
     * Counts items in the collection.
     */
    final public function count(): int
    {
        return $this->items->count();
    }

    /**
     * Clears all items.
     */
    final public function clear(): void
    {
        $this->items->clear();
    }

    /**
     * Clones the collection.
     *
     * @throws ReflectionException
     */
    final public function copy(): static
    {
        $reflection = new ReflectionClass(static::class);

        return $reflection->newInstanceArgs([...$this->items->values()->toArray()]);
    }

    /**
     * Checks if the collection is empty.
     */
    final public function isEmpty(): bool
    {
        return $this->items->isEmpty();
    }

    /**
     * Converts collection to an array.
     *
     * @return array<TValue>
     */
    final public function toArray(): array
    {
        return array_values($this->items->toArray());
    }

    /**
     * Converts the collection to JSON.
     */
    final public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Allows iteration over the collection.
     *
     * @return ArrayIterator<TKey, TValue>
     */
    final public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items->toArray());
    }

    /**
     * Adds an item with a specific key.
     *
     * @param  TKey  $key
     * @param  TValue  $item
     */
    protected function addWithKey(mixed $key, mixed $item): void
    {
        $this->items->put($key, $item);
    }
}
