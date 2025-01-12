<?php

namespace App\Domain\ChallengeGroup\Exceptions;

use Exception;

class ChallengeGroupNotFound extends Exception
{
    public function __construct()
    {
        parent::__construct('Challenge group not found');
    }
}
