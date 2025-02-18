<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repositories\ChallengeGroup;

use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Data\CreateChallengeGroupData;
use App\Domain\ChallengeGroup\Data\UpdateChallengeGroupData;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\Shared\Exceptions\DomainException;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;
use DateTimeImmutable;

final class ChallengeGroupEloquentRepository implements ChallengeGroupRepository
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
    public function update(UpdateChallengeGroupData $challenge_group_data): ChallengeGroupEntity
    {
        $challenge_group = ChallengeGroup::where([
            'id' => $challenge_group_data->getId(),
            'created_by' => $challenge_group_data->getOwnerId(),
        ])->first();
        if ($challenge_group === null) {
            throw new DomainException('Challenge group does not exist');
        }
        if (! in_array($challenge_group_data->getName(), [null, '', '0'], true)) {
            $challenge_group->name = $challenge_group_data->getName();
        }
        if ($challenge_group_data->getEndDate() instanceof DateTimeImmutable) {
            $challenge_group->end_date = $challenge_group_data->getEndDate();
        }
        $challenge_group->save();

        return new ChallengeGroupEntity(
            $challenge_group->id,
            $challenge_group->name,
            $challenge_group->end_date,
            $challenge_group->created_by,
            $challenge_group->created_at,
            $challenge_group->updated_at,
        );
    }

    public function delete(int $id, int $created_by): bool
    {
        $deleted_rows = ChallengeGroup::where([
            'id' => $id,
            'created_by' => $created_by,
        ])->delete();

        return $deleted_rows > 0;
    }

    public function hasMember(int $id, int $user_id): bool
    {
        return ChallengeGroup::join(
            'challenge_groups_users',
            'challenge_groups_users.challenge_group_id', '=', 'challenge_groups.id'
        )->where([
            'challenge_groups_users.challenge_group_id' => $id,
            'challenge_groups_users.user_id' => $user_id,
        ])->exists();
    }

    public function find(int $id): ?ChallengeGroupEntity
    {
        $challenge_group = ChallengeGroup::find($id);
        if ($challenge_group === null) {
            return null;
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

    /**
     * @throws DomainException
     */
    public function findOrFail(int $id, int $created_by): ChallengeGroupEntity
    {
        $challenge_group = ChallengeGroup::where([
            'id' => $id,
            'created_by' => $created_by,
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
