<?php

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\Auth\DTOs\UserDTO;
use App\Application\ChallengeGroups\DTOs\ChallengeGroupDTO;
use App\Application\Shared\UseCase;
use App\Domain\Auth\Entities\UserEntity;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Services\ChallengeGroupService;
use App\Domain\Shared\Exceptions\DomainAuthorizationException;

readonly class GetChallengeGroupUseCase extends UseCase
{
    public function __construct(
        private ChallengeGroupService $service
    ) {}

    /**
     * @throws DomainAuthorizationException
     */
    public function execute(UserDTO $user_dto, ChallengeGroupDTO $challenge_group_dto): ChallengeGroupEntity
    {
        return $this->service->get(
            new UserEntity(...$user_dto),
            new ChallengeGroupEntity(...$challenge_group_dto)
        );
    }
}
