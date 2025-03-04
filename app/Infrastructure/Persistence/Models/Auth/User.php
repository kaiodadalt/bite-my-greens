<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Models\Auth;

use Laravel\Passport\HasApiTokens;

/**
 * @property mixed $pivot
 */
final class User extends BaseUser
{
    use HasApiTokens;
}
