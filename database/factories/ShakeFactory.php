<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shake;
use App\User;
use Faker\Generator as Faker;

$factory->define(Shake::class, function (Faker $faker) {
    return [
        'title' =>
            $faker->randomElement(
                ['Apple Goodness', 'Cherry Shake', 'Banana Havana', 'Frozen Banana Shake', 'Milk Shake', 'Ice Cream Shake', 'Kiwi Owe Wee']
            ) . ' ' . $faker->randomDigit,
        'user_id' => factory(User::class),
    ];
});
