<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ShakeIngredient;
use App\Shake;
use Faker\Generator as Faker;

$factory->define(ShakeIngredient::class, function (Faker $faker) {
    return [
        'shake_id' => $faker->randomDigit,
        'val' => $faker->randomElement(['1 Apple', '1 oz Cherry', 'Bananna', 'Frozen Bananna', '1 Cup whole Milk', '2 Scoops Ice Cream', '1 Kiwi']),
    ];
});
