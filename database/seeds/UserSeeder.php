<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

    	$user = App\User::where(['email' => 'test@gmail.com'])->first();
        //create test user
        if($user === null){
	        $user = factory(App\User::class)->create([
	            'email' => 'test@gmail.com',
	            'password' => Hash::make('dev_pass')
	        ]);
	        $user->assignRole('super-admin');
	    }
    }
}
