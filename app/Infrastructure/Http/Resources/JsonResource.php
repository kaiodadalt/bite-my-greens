<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Resources;

use App\Domain\Shared\Helpers\Collection;
use Illuminate\Http\Resources\Json\JsonResource as BaseJsonResource;

abstract class JsonResource extends BaseJsonResource
{
    final public static function collection(mixed $resource): array
    {
        /* @var Collection $resource */
        return array_map(fn (mixed $item) => static::make($item), $resource->toArray());
    }
}
