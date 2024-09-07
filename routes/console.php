<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('debug', function () {
    var_dump('test');
});
