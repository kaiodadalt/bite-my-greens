<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Models\UniqueID;

use App\Infrastructure\Persistence\Models\Auth\BaseUser;

final class UuidUser extends BaseUser
{
    use HasUniqueID;

    // Remember, the users table should have:
    // $table->binary('id', 16)->primary();
    protected $casts = [
        'id' => UserUniqueID::class,
    ];
}
