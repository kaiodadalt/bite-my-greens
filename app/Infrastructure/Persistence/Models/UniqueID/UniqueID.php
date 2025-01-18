<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Models\UniqueID;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Str;

abstract class UniqueID implements CastsAttributes
{
    public const PREFIX = '';

    /**
     * Read from the database (binary(16)) and cast to a hex string with optional prefix.
     */
    public function get($model, string $key, $value, array $attributes): ?string
    {
        if (is_null($value)) {
            return null;
        }

        $hex = bin2hex($value);

        return static::PREFIX.$hex;
    }

    /**
     * Write to the database:
     *   - Remove any prefix
     *   - Strip dashes if it's a standard UUID
     *   - Convert to binary(16)
     */
    public function set($model, string $key, $value, array $attributes)
    {
        // If the value is empty, generate a new one
        if (empty($value)) {
            $value = static::generate();
        }

        // Remove the prefix (e.g. "usr_") if present
        if (static::PREFIX && str_starts_with($value, static::PREFIX)) {
            $value = substr($value, strlen(static::PREFIX));
        }

        // If the value is a standard UUID with dashes, remove them
        // (e.g. "5cb6b3b4-b8d2-4063-9857-83f960c252d9" -> "5cb6b3b4b8d24063985783f960c252d9")
        $value = str_replace('-', '', $value);

        // Convert the (32-char) hex string into raw binary(16)
        return hex2bin($value);
    }

    /**
     * Generate a new UUID (with dashes).
     * We'll remove the dashes in set() before storing.
     */
    public static function generate(): string
    {
        return (string) Str::uuid();
    }
}
