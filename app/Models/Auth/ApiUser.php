<?php

namespace App\Models\Auth;

use Laravel\Sanctum\HasApiTokens;

class ApiUser extends BaseUser
{
    use HasApiTokens;
}
