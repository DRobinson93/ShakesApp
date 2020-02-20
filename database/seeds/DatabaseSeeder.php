<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //could use env var to run only live seeds
        $this->call(UserSeeder::class);
        $this->call(ShakeSeeder::class);
        $this->call(ShakeReactionSeeder::class);
    }
}
