<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\UniqueID;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class UniqueID implements CastsAttributes
{
    public const PREFIX = '';

    /**
     * Generate a new UUID (with dashes).
     * We'll remove the dashes in set() before storing.
     */
    final public static function generate(): string
    {
        return (string) Str::uuid();
    }

    /**
     * Read from the database (binary(16)) and cast to a hex string with optional prefix.
     */
    final public function get(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if (is_null($value)) {
            return null;
        }

        $hex = bin2hex((string) $value);

        return static::PREFIX.$hex;
    }

    /**
     * Write to the database:
     *   - Remove any prefix
     *   - Strip dashes if it's a standard UUID
     *   - Convert to binary(16)
     */
    final public function set(Model $model, string $key, $value, array $attributes)
    {
        // If the value is empty, generate a new one
        if (empty($value)) {
            $value = static::generate();
        }

        // Remove the prefix (e.g. "usr_") if present
        if (static::PREFIX && str_starts_with((string) $value, (string) static::PREFIX)) {
            $value = mb_substr((string) $value, mb_strlen((string) static::PREFIX));
        }

        // If the value is a standard UUID with dashes, remove them
        // (e.g. "5cb6b3b4-b8d2-4063-9857-83f960c252d9" -> "5cb6b3b4b8d24063985783f960c252d9")
        $value = str_replace('-', '', $value);

        // Convert the (32-char) hex string into raw binary(16)
        return hex2bin($value);
    }
}
