<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Exceptions;

use Exception;

final class UserNotAllowedToPostException extends Exception
{
    public function __construct()
    {
        parent::__construct('You are not allowed to post in this challenge group');
    }
}
