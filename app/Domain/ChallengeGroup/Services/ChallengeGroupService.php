<?php
declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Data\CreateChallengeGroupData;
use App\Domain\ChallengeGroup\Data\UpdateChallengeGroupData;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFound;

final readonly class ChallengeGroupService
{
    public function __construct(
        private AuthorizeChallengeGroupService $auth,
        private ChallengeGroupRepository $repository,
    ) {}

    public function create(CreateChallengeGroupData $challenge_group_data): ChallengeGroupEntity
    {
        return $this->repository->create($challenge_group_data);
    }

    /**
     * @throws ChallengeGroupNotFound
     */
    public function get(int $user_id, int $challenge_group_id): ChallengeGroupEntity
    {
        $challenge_group = $this->repository->find($challenge_group_id);
        if (!$challenge_group || $this->auth->cannotView($user_id, $challenge_group)) {
            throw new ChallengeGroupNotFound();
        }
        return $challenge_group;
    }

    /**
     * @throws ChallengeGroupNotFound
     */
    public function update(int $user_id, UpdateChallengeGroupData $challenge_group_data): ChallengeGroupEntity
    {
        $challenge_group = $this->repository->find($challenge_group_data->getId());
        if (!$challenge_group || $this->auth->cannotUpdate($user_id, $challenge_group)) {
            throw new ChallengeGroupNotFound();
        }
        if ($challenge_group_data->getName()) {
            $challenge_group->setName($challenge_group_data->getName());
        }
        if ($challenge_group_data->getEndDate()) {
            $challenge_group->setEndDate($challenge_group_data->getEndDate());
        }
        $this->repository->update($challenge_group);
        return $challenge_group;
    }

    /**
     * @throws ChallengeGroupNotFound
     */
    public function delete(int $user_id, int $challenge_group_id): bool
    {
        $challenge_group = $this->repository->find($challenge_group_id);
        if (!$challenge_group || $this->auth->cannotDelete($user_id, $challenge_group)) {
            throw new ChallengeGroupNotFound();
        }
        return $this->repository->delete($challenge_group);
    }
}
