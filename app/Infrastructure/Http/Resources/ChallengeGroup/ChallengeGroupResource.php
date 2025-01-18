<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Resources\ChallengeGroup;

use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChallengeGroupResource extends JsonResource
{
    public static $wrap = null;

    public function __construct(ChallengeGroupEntity $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->getId(),
            'name' => $this->resource->getName(),
            'end_date' => $this->resource->getEndDate()->format('Y-m-d'),
            'created_by' => $this->resource->getOwnerId(),
            'created_at' => $this->resource->getCreatedAt(),
        ];
    }
}
