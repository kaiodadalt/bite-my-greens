<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Resources\ChallengeGroup;

use App\Domain\ChallengeGroup\Entities\ChallengeGroupPostEntity;
use App\Infrastructure\Http\Resources\JsonResource;
use Illuminate\Http\Request;

final class PostResource extends JsonResource
{
    public static $wrap;

    public function __construct(ChallengeGroupPostEntity $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        /** @var ChallengeGroupPostEntity $post */
        $post = $this->resource;

        return [
            'id' => $post->getId(),
            'challenge_group_id' => $post->getChallengeGroupId(),
            'user_id' => $post->getUserId(),
            'description' => $post->getDescription(),
            'image' => $post->getImage(),
            'score' => $post->getScore(),
            'created_at' => $post->getCreatedAt(),
        ];
    }
}
