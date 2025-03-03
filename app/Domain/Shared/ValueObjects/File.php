<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObjects;

final readonly class File
{
    public function __construct(
        private string $original_name,
        private int $size,
        private string $path,
        private ?string $mime_type,
    ) {}

    public function getOriginalName(): string
    {
        return $this->original_name;
    }

    public function getMimeType(): ?string
    {
        return $this->mime_type;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
