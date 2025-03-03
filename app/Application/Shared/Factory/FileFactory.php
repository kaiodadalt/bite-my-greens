<?php

declare(strict_types=1);

namespace App\Application\Shared\Factory;

use App\Domain\Shared\ValueObjects\File;
use Illuminate\Http\UploadedFile;

final class FileFactory
{
    public static function fromUploadedFile(UploadedFile $uploaded_file): File
    {
        return new File(
            $uploaded_file->getClientOriginalName(),
            $uploaded_file->getSize(),
            $uploaded_file->path(),
            $uploaded_file->getMimeType(),
        );
    }
}
