<?php

namespace App\Infrastructure\Persistence\Models\UniqueID;

/**
 * @method static creating(\Closure $param)
 */
trait HasUniqueID
{
    protected static function bootUuidTrait(): void
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = UniqueID::generate();
            }
        });
    }
}
