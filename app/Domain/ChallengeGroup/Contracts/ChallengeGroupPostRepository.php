<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Contracts;

use App\Domain\ChallengeGroup\Data\AddChallengeGroupPostData;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupPostEntity;

interface ChallengeGroupPostRepository
{
    public function create(AddChallengeGroupPostData $challenge_group_post): ChallengeGroupPostEntity;
}
