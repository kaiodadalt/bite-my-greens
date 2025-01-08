<?php

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\Auth\DTOs\UserDTO;
use App\Application\ChallengeGroups\DTOs\ChallengeGroupDTO;
use App\Domain\Auth\Entities\UserEntity;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\Shared\Exceptions\DomainAuthorizationException;

readonly class DeleteChallengeGroupUseCase extends ChallengeGroupUseCase
{
    /**
     * @throws DomainAuthorizationException
     */
    public function execute(UserDTO $user_dto, ChallengeGroupDTO $challenge_group_dto): bool
    {
        return $this->service->delete(
            new UserEntity(...$user_dto),
            new ChallengeGroupEntity(...$challenge_group_dto)
        );
    }
}
