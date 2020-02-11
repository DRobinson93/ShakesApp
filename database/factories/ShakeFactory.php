<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shake;

$factory->define(Shake::class, function () {
    return [
        'title' => Str::random(10)
    ];
});
