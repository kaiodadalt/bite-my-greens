<?php

namespace App\Models\Auth;

use Laravel\Passport\HasApiTokens;

class User extends BaseUser
{
    use HasApiTokens;
}
