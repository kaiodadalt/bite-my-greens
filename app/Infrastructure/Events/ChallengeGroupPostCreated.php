<?php

declare(strict_types=1);

namespace App\Infrastructure\Events;

use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupPost;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class ChallengeGroupPostCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private readonly ChallengeGroupPost $post,
    ) {}
}
