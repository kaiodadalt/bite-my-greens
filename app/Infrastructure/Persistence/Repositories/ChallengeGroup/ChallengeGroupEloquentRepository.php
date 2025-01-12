<?php

namespace App\Infrastructure\Persistence\Repositories\ChallengeGroup;


use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Data\CreateChallengeGroupData;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\Shared\Exceptions\DomainException;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;

class ChallengeGroupEloquentRepository implements ChallengeGroupRepository
{
    public function create(CreateChallengeGroupData $challenge_group_data): ChallengeGroupEntity
    {
        $created_model = ChallengeGroup::create([
            'name' => $challenge_group_data->getName(),
            'end_date' => $challenge_group_data->getEndDate(),
            'created_by' => $challenge_group_data->getOwnerId(),
        ]);
        return new ChallengeGroupEntity(
            $created_model->id,
            $created_model->name,
            $created_model->end_date,
            $created_model->created_by,
            $created_model->created_at,
            $created_model->updated_at,
        );
    }

    /**
     * @throws DomainException
     */
    public function update(ChallengeGroupEntity $challenge_group): ChallengeGroupEntity
    {
        $this->findOrFail(
            $challenge_group->getId(),
            $challenge_group->getOwnerId()
        );

        ChallengeGroup::where([
            'id' => $challenge_group->getId(),
            'created_by' => $challenge_group->getOwnerId()
        ])->update(array_filter([
            'name' => $challenge_group->getName(),
            'end_date' => $challenge_group->getEndDate(),
        ]));

        return $challenge_group;
    }

    public function delete(ChallengeGroupEntity $challenge_group): bool
    {
        return ChallengeGroup::where([
            'id' => $challenge_group->getId(),
            'created_by' => $challenge_group->getOwnerId()
        ])->delete();
    }

    public function hasMember(ChallengeGroupEntity $challenge_group, int $user_id): bool
    {
        return ChallengeGroup::join(
            'challenge_groups_users',
            'challenge_groups_users.challenge_group_id', '=', 'challenge_groups.id'
        )->where([
            'challenge_groups_users.challenge_group_id' => $challenge_group->getId(),
            'challenge_groups_users.user_id' => $user_id,
        ])->exists();
    }

    /**
     * @throws DomainException
     */
    public function findOrFail(int $id, int $user_id): ChallengeGroupEntity
    {
        $challenge_group = ChallengeGroup::where([
            'id' => $id,
            'created_by' => $user_id,
        ])->first();
        if ($challenge_group === null) {
            throw new DomainException('Challenge group does not exist');
        }
        return new ChallengeGroupEntity(
            $challenge_group->id,
            $challenge_group->name,
            $challenge_group->end_date,
            $challenge_group->created_by,
            $challenge_group->created_at,
            $challenge_group->updated_at,
        );
    }
}

