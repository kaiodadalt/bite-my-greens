<?php

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\Auth\DTOs\UserDTO;
use App\Application\ChallengeGroups\DTOs\ChallengeGroupDTO;
use App\Application\Shared\UseCase;
use App\Domain\Auth\Entities\UserEntity;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Services\ChallengeGroupService;
use App\Domain\Shared\Exceptions\DomainAuthorizationException;

readonly class UpdateChallengeGroupUseCase extends UseCase
{
    public function __construct(
        private ChallengeGroupService $service
    ) {}

    /**
     * @throws DomainAuthorizationException
     */
    public function execute(UserDTO $user_dto, ChallengeGroupDTO $challenge_group_dto): ChallengeGroupEntity
    {
        $user = new UserEntity(
            $user_dto->id,
            $user_dto->name,
            $user_dto->email
        );
        $challenge_group = new ChallengeGroupEntity(
            $challenge_group_dto->id,
            $challenge_group_dto->name,
            $challenge_group_dto->end_date,
            $challenge_group_dto->created_by
        );
        return $this->service->update($user, $challenge_group);
    }
}
