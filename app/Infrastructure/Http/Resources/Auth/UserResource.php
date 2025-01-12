<?php
declare(strict_types=1);

namespace App\Infrastructure\Http\Resources\Auth;

use App\Infrastructure\Persistence\Models\Auth\BaseUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function __construct(BaseUser $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'created_at' => $this->resource->created_at,
        ];
    }
}
