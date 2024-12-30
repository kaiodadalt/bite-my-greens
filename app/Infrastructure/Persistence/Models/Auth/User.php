<?php

namespace App\Infrastructure\Persistence\Models\Auth;

use Laravel\Passport\HasApiTokens;

class User extends BaseUser
{
    use HasApiTokens;
}
