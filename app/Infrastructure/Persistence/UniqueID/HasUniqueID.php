<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\UniqueID;

trait HasUniqueID
{
    //    protected $keyType = 'string';

    //    public $incrementing = false;

    protected static function bootUuidTrait(): void
    {
        static::creating(function ($model): void {
            if (! $model->id) {
                $model->id = UniqueID::generate();
            }
        });
    }
}
