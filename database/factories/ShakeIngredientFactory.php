<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ShakeIngredient;
use App\Shake;
use Faker\Generator as Faker;

$factory->define(ShakeIngredient::class, function (Faker $faker) {
    return [
        'shake_id' => factory(Shake::class),
        'val' => Str::random(10),
    ];
});
