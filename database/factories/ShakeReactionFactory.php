<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ShakeReaction;
use App\Shake;
use App\User;
use Faker\Generator as Faker;

$factory->define(ShakeReaction::class, function (Faker $faker) {
    return [
        'shake_id' => factory(Shake::class),
        'user_id' => factory(User::class),
        'val' => $faker->numberBetween(-1, 1)
    ];
});

