<?php

namespace Tests\Unit;

use App\ShakeReaction;
use \App\User;
use \App\Shake;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCanCreate()
    {
        //create user using factory
        $user = factory(User::class)->make();//fn create would insert
        $this->assertTrue($user->save());
        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }

    public function testHasCorrectCols(){
        $this->assertTrue(
            Schema::hasColumns('users',
                $this->getColsWithShared(
                    ['name', 'email', 'email_verified_at',
                    'password', 'remember_token']
                )
            )
        );
    }

    public function testHasReactions()
    {
        $user = factory(User::class)->create();
        //insert ShakeReaction
        factory(ShakeReaction::class)->create(['user_id' => $user->id]);
        factory(ShakeReaction::class)->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Collection::class,$user->reactions);
        foreach($user->reactions as $reaction)
            $this->assertInstanceOf(ShakeReaction::class,$reaction);

        $this->assertEquals(2, $user->reactions->count());
    }

    public function testHasShakes()
    {
        $user = factory(User::class)->create();
        //insert ShakeReaction
        factory(Shake::class)->create(['user_id' => $user->id]);
        factory(Shake::class)->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Collection::class,$user->shakes);
        foreach($user->shakes as $shake)
            $this->assertInstanceOf(Shake::class,$shake);

        $this->assertEquals(2, $user->shakes->count());
    }
}
