<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Mappers;

use App\Domain\ChallengeGroup\Entities\ChallengeGroupPostEntity;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupPostEntityCollection;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupPost;

final readonly class PostMapper
{
    public static function map(ChallengeGroupPost $post): ChallengeGroupPostEntity
    {
        return new ChallengeGroupPostEntity(
            $post->id,
            $post->challenge_group_id,
            $post->user_id,
            $post->description,
            $post->image,
            $post->score,
            $post->created_at,
            $post->updated_at,
        );
    }

    public static function mapCollection(ChallengeGroupPost ...$posts): ChallengeGroupPostEntityCollection
    {
        return new ChallengeGroupPostEntityCollection(...array_map(self::map(...), $posts));
    }
}
