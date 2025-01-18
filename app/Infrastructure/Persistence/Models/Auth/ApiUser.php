<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Models\Auth;

use Laravel\Sanctum\HasApiTokens;

final class ApiUser extends BaseUser
{
    use HasApiTokens;
}
