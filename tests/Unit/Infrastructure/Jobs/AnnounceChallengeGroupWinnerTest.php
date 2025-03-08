<?php

declare(strict_types=1);

use App\Infrastructure\Jobs\AnnounceChallengeGroupWinner;

it('announce a challenge group winner', function () {
    $announcer = new AnnounceChallengeGroupWinner();
    $announcer->handle();
    expect($announcer)->toBeInstanceOf(AnnounceChallengeGroupWinner::class);
});
