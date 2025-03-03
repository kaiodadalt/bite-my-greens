<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Services;

use App\Domain\ChallengeGroup\Contracts\ChallengeGroupPostRepository;
use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Data\AddChallengeGroupPostData;
use App\Domain\ChallengeGroup\Data\CreateChallengeGroupData;
use App\Domain\ChallengeGroup\Data\UpdateChallengeGroupData;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFoundException;
use App\Domain\ChallengeGroup\Exceptions\UserNotAllowedToPostException;

final readonly class ChallengeGroupService
{
    public function __construct(
        private AuthorizeChallengeGroupService $auth,
        private ChallengeGroupRepository $repository,
        private ChallengeGroupPostRepository $post_repository,
    ) {}

    public function create(CreateChallengeGroupData $challenge_group_data): ChallengeGroupEntity
    {
        return $this->repository->create($challenge_group_data);
    }

    /**
     * @throws ChallengeGroupNotFoundException
     */
    public function get(int $user_id, int $challenge_group_id): ChallengeGroupEntity
    {
        $challenge_group = $this->repository->find($challenge_group_id);
        if (! $challenge_group instanceof ChallengeGroupEntity || $this->auth->cannotView($user_id, $challenge_group)) {
            throw new ChallengeGroupNotFoundException;
        }

        return $challenge_group;
    }

    /**
     * @throws ChallengeGroupNotFoundException
     */
    public function update(UpdateChallengeGroupData $challenge_group_data): ChallengeGroupEntity
    {
        $challenge_group = $this->repository->find($challenge_group_data->getId());
        if (! $challenge_group instanceof ChallengeGroupEntity || $this->auth->cannotUpdate($challenge_group_data->getOwnerId(), $challenge_group)) {
            throw new ChallengeGroupNotFoundException;
        }

        return $this->repository->update($challenge_group_data);
    }

    /**
     * @throws ChallengeGroupNotFoundException
     */
    public function delete(int $user_id, int $challenge_group_id): bool
    {
        $challenge_group = $this->repository->find($challenge_group_id);
        if (! $challenge_group instanceof ChallengeGroupEntity || $this->auth->cannotDelete($user_id, $challenge_group)) {
            throw new ChallengeGroupNotFoundException;
        }

        return $this->repository->delete($challenge_group_id, $user_id);
    }

    /**
     * @throws ChallengeGroupNotFoundException
     * @throws UserNotAllowedToPostException
     */
    public function post(AddChallengeGroupPostData $post): void
    {
        $challenge_group = $this->repository->find($post->getChallengeGroupId());
        if (! $challenge_group instanceof ChallengeGroupEntity) {
            throw new ChallengeGroupNotFoundException;
        }

        if ($this->auth->cannotPost($post->getUserId(), $challenge_group)) {
            throw new UserNotAllowedToPostException();
        }

        $this->post_repository->create($post);
    }
}
