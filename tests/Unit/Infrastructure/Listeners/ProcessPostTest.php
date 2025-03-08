<?php

declare(strict_types=1);

use App\Infrastructure\Listeners\ProcessPost;

it('process a post', function () {
    $process_post = new ProcessPost();
    $process_post->handle();
    expect($process_post)->toBeInstanceOf(ProcessPost::class);
});
