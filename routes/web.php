<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $test = "asd";
//    phpinfo();
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';
