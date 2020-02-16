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
            $shake->ingredients()->save(factory(App\ShakeIngredient::class)->make());
        });
    }
}
