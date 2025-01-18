<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $test = 'asd';

    //    phpinfo();
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';
// require __DIR__.'/passport.php';
