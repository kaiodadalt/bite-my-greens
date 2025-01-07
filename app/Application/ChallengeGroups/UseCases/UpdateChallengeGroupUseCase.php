<?php

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\Auth\DTOs\UserDTO;
use App\Application\ChallengeGroups\DTOs\UpdateChallengeGroupDTO;
use App\Application\Shared\UseCase;
use App\Domain\Auth\Entities\UserEntity;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Services\UpdateChallengeGroupService;
use App\Domain\Shared\Exceptions\DomainAuthorizationException;
use App\Domain\Shared\Exceptions\DomainException;

readonly class UpdateChallengeGroupUseCase extends UseCase
{
    public function __construct(
        private UpdateChallengeGroupService $service
    ) {}

    /**
     * @throws DomainException|DomainAuthorizationException
     */
    public function execute(UserDTO $user_dto, UpdateChallengeGroupDTO $challenge_group_dto): ChallengeGroupEntity
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
