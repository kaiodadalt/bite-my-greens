<?php

namespace App\Infrastructure\Persistence\Repositories\ChallengeGroup;


use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\DomainException;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;

class ChallengeGroupEloquentRepository implements ChallengeGroupRepository
{
    public function create(ChallengeGroupEntity $challenge_group): ChallengeGroupEntity
    {
        $created_model = ChallengeGroup::create([
            'name' => $challenge_group->name,
            'end_date' => $challenge_group->end_date,
            'created_by' => $challenge_group->created_by,
        ]);
        $challenge_group->id = $created_model->id;
        $challenge_group->created_at = $created_model->created_at;
        $challenge_group->updated_at = $created_model->updated_at;

        return $challenge_group;
    }

    public function update(ChallengeGroupEntity $challenge_group): ChallengeGroupEntity
    {
        $this->findOrFail(
            $challenge_group->id,
            $challenge_group->created_by
        );

        ChallengeGroup::where([
            'id' => $challenge_group->id,
            'created_by' => $challenge_group->created_by
        ])->update(array_filter([
            'name' => $challenge_group->name,
            'end_date' => $challenge_group->end_date,
        ]));

        return $challenge_group;
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

