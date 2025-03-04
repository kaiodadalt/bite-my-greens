<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Mappers;

use App\Domain\Auth\Entities\UserEntity;
use App\Domain\Auth\Entities\UserEntityCollection;
use App\Infrastructure\Persistence\Models\Auth\User;

final readonly class UserMapper
{
    public static function map(User $user): UserEntity
    {
        return new UserEntity(
            $user->id,
            $user->name,
            $user->email,
        );
    }

    public static function mapCollection(User ...$users): UserEntityCollection
    {
        return new UserEntityCollection(...array_map(self::map(...), $users));
    }
}
