<?php

use Illuminate\Database\Seeder;

class ShakeReactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::get();
        $shakes = App\Shake::get();
        foreach($shakes as $shake){
            foreach($users as $user){
                factory(App\ShakeReaction::class)->create([
                   'user_id' => $user['id'],
                   'shake_id' => $shake['id']
                ]);
            }
        }
    }
}
