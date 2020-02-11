<?php

namespace Tests\Unit;

use App\Shake;
use \App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
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
}
