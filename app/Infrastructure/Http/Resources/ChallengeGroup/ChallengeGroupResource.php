<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Resources\ChallengeGroup;

use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Infrastructure\Http\Resources\Auth\UserResource;
use App\Infrastructure\Http\Resources\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

final class ChallengeGroupResource extends JsonResource
{
    public static $wrap;

    public function __construct(ChallengeGroupEntity $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        /** @var ChallengeGroupEntity $challenge_group */
        $challenge_group = $this->resource;

        $challenge_group_array = [
            'id' => $challenge_group->getId(),
            'name' => $challenge_group->getName(),
            'challenge_code' => Crypt::encrypt($challenge_group->getId()),
            'end_date' => $challenge_group->getEndDate()->format('Y-m-d'),
            'owner' => new UserResource($challenge_group->getOwner()),
            'created_at' => $challenge_group->getCreatedAt(),
        ];

        if (! $challenge_group->getParticipants()->isEmpty()) {
            $challenge_group_array['participants'] = UserResource::collection($challenge_group->getParticipants());
        }

        if (! $challenge_group->getPosts()->isEmpty()) {
            $challenge_group_array['posts'] = PostResource::collection($challenge_group->getPosts());
        }

        return $challenge_group_array;
    }
}
