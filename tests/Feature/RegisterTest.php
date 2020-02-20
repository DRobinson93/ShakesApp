<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegisteredEvent()
    {
        Event::fake();
        $request = $this
            ->postJson('register', [
                'name' => 'Dan',
                'email' => 'test@gmail.com',
                'password' =>'test_pwd',
                'password_confirmation' => 'test_pwd'
            ]);
        $request->assertRedirect(route('home'));
        Event::assertDispatched(Registered::class);
    }
}
