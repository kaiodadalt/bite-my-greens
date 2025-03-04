<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Resources\Auth;

use App\Domain\Auth\Entities\UserEntity;
use App\Infrastructure\Http\Resources\JsonResource;
use Illuminate\Http\Request;

final class UserResource extends JsonResource
{
    public function __construct(UserEntity $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        /** @var UserEntity $user */
        $user = $this->resource;

        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ];
    }
}
