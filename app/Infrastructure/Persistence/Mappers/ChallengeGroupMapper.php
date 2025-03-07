<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Mappers;

use App\Domain\Auth\Entities\UserEntityCollection;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntityCollection;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupPostEntityCollection;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;

final readonly class ChallengeGroupMapper
{
    public static function map(ChallengeGroup $challenge_group): ChallengeGroupEntity
    {
        if ($challenge_group->relationLoaded('posts')) {
            $posts = PostMapper::mapCollection(...$challenge_group->posts);
        } else {
            $posts = new ChallengeGroupPostEntityCollection();
        }

        if ($challenge_group->relationLoaded('participants')) {
            $participants = UserMapper::mapCollection(...$challenge_group->participants);
        } else {
            $participants = new UserEntityCollection();
        }

        return new ChallengeGroupEntity(
            $challenge_group->id,
            $challenge_group->name,
            $challenge_group->end_date,
            UserMapper::map($challenge_group->creator),
            $participants,
            $posts,
            $challenge_group->created_at,
            $challenge_group->updated_at,
        );
    }

    public static function mapCollection(ChallengeGroup ...$challenge_groups): ChallengeGroupEntityCollection
    {
        return new ChallengeGroupEntityCollection(...array_map(self::map(...), $challenge_groups));
    }
}
