<?php

namespace App\Models\UniqueID;

use App\Models\Auth\BaseUser;

class UuidUser extends BaseUser
{
    use HasUniqueID;
    protected $keyType = 'string';
    public $incrementing = false;

    // Remember, the users table should have:
    // $table->binary('id', 16)->primary();
    protected $casts = [
        'id' => UserUniqueID::class,
    ];
}
