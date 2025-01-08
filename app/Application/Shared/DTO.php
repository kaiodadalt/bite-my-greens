<?php

namespace App\Application\Shared;

use ArrayIterator;
use IteratorAggregate;

abstract class DTO implements IteratorAggregate
{
    public abstract function toArray(): array;

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->toArray());
    }
}
