<?php

namespace App\Domain;

use Exception;

class DomainException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
