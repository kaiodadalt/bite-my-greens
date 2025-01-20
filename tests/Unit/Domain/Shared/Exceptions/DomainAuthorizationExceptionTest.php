<?php

declare(strict_types=1);

use App\Domain\Shared\Exceptions\DomainAuthorizationException;

it('throws DomainAuthorizationException', function () {
    throw new DomainAuthorizationException('You are not authorized to perform this action');
})->throws(DomainAuthorizationException::class);
