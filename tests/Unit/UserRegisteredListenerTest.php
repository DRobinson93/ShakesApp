<?php

namespace Tests\Feature;

use App\Listeners\UserRegisteredListener;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;

class UserRegisteredListenerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    protected $user;
    public function setUp() :void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->seed(\RolesAndPermissionsSeeder::class);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     *
     */
    public function testHandleRegister()
    {
        $listener = new UserRegisteredListener();
        $listener->handle(new Registered($this->user));

        $this->assertTrue($this->user->hasRole('user'));
    }
}
