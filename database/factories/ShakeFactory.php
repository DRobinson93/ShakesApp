<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shake;
use App\User;

$factory->define(Shake::class, function () {
    return [
        'title' => Str::random(10),
        'user_id' => factory(User::class),
    ];
});
