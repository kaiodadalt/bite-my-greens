<?php

namespace App\Application;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract readonly class UseCase
{
    use AuthorizesRequests;
}
