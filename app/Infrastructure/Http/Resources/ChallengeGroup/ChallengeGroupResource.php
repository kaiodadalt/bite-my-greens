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

        return [
            'id' => $challenge_group->getId(),
            'name' => $challenge_group->getName(),
            'challenge_code' => Crypt::encrypt($challenge_group->getId()),
            'end_date' => $challenge_group->getEndDate()->format('Y-m-d'),
            'owner' => new UserResource($challenge_group->getOwner()),
            'participants' => UserResource::collection($challenge_group->getParticipants()),
            'created_at' => $challenge_group->getCreatedAt(),
        ];
    }
}
