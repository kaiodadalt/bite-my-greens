<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Models\UniqueID;

/**
 * @method static creating(\Closure $param)
 */
trait HasUniqueID
{
    protected $keyType = 'string';
    protected $incrementing = false;
    protected static function bootUuidTrait(): void
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = UniqueID::generate();
            }
        });
    }
}
