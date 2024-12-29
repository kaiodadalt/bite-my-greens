<?php

namespace App\Http\Resources\ChallengeGroup;

use App\Models\Auth\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property int $created_by
 * @property string $name
 * @property DateTime $end_date
 * @property User $creator
 */
class ChallengeGroupResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'end_date' => $this->end_date,
            'creator' => $this->creator,
        ];
    }
}
