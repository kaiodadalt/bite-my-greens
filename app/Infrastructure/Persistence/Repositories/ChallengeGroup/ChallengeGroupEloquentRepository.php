<?php

namespace App\Infrastructure\Persistence\Repositories\ChallengeGroup;


use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;

class ChallengeGroupEloquentRepository implements ChallengeGroupRepository
{
    public function save(ChallengeGroupEntity $challenge_group): ChallengeGroupEntity
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
}

