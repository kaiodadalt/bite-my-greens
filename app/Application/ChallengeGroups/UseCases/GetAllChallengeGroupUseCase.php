<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\UseCases;

use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntityCollection;

final readonly class GetAllChallengeGroupUseCase extends ChallengeGroupUseCase
{
    public function execute(int $user_id): ChallengeGroupEntityCollection
    {
        return $this->service->getAll($user_id);
    }
}
