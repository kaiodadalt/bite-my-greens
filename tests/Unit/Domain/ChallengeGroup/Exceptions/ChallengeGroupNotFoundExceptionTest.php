<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFoundException;

it('throws ChallengeGroupNotFoundException', function () {
    throw new ChallengeGroupNotFoundException();
})->throws(ChallengeGroupNotFoundException::class, 'Challenge group not found');
