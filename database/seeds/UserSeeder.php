<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create 10 random users
        factory(App\User::class, 10)->create();

        //create test user
        factory(App\User::class)->create([
            'email' => 'test@gmail.com',
            'password' => 'dev_pass'
        ]);
    }
}
