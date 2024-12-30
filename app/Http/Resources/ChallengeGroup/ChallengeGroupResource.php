<?php

namespace App\Http\Resources\ChallengeGroup;

use App\Http\Resources\Auth\UserResource;
use App\Models\ChallengeGroups\ChallengeGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChallengeGroupResource extends JsonResource
{
    public function __construct(ChallengeGroup $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'end_date' => $this->resource->end_date,
            'creator' => new UserResource($this->resource->creator),
            'created_at' => $this->resource->created_at,
        ];
    }
}
