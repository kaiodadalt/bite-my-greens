<?php

declare(strict_types=1);

use App\Domain\Shared\ValueObjects\File;

it('creates a File correctly', function () {
    $file = new File(
        $name = 'file.jpg',
        $size = 1000,
        $path = 'path/to/file.jpg',
        $type = 'image/jpeg',
    );

    expect($file->getOriginalName())->toBe($name)
        ->and($file->getSize())->toBe($size)
        ->and($file->getPath())->toBe($path)
        ->and($file->getMimeType())->toBe($type);
});
