<?php

use Illuminate\Database\Seeder;

class ShakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create 10 random shakes
        factory(App\Shake::class, 10)->create()->each(function ($shake) {
            $numOfIngredients = random_int(2,6);

            // For each shake, create 2 - 6 ingredients
            for ($i = 1; $i <= $numOfIngredients; $i++) {
                $shake->ingredients()->save(factory(App\ShakeIngredient::class)->make(['shake_id' => $shake->id]));
            }
        });
    }
}
