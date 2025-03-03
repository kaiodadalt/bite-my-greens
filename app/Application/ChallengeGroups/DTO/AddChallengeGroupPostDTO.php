<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\DTO;

use App\Application\Shared\DTO;
use App\Domain\Shared\ValueObjects\File;

final readonly class AddChallengeGroupPostDTO extends DTO
{
    public function __construct(
        public int $challenge_group_id,
        public string $description,
        public File $image,
    ) {}
}
