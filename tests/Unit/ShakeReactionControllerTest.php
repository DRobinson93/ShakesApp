<?php

namespace Tests\Unit;

use App\Shake;
use App\User;
use App\ShakeReaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ShakeReactionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    protected static $user, $shake;

    public function setUp() :void
    {
        parent::setUp();
        self::$user = factory(User::class)->create();
        self::$shake = factory(Shake::class)->create();
    }

    public function testInvalidCreateMissingUser(){
        //test not logged in
        $response =
            $this->postJson(route('shake.reaction.store', self::$shake), ['val' => '1']);
        $response->assertStatus(
            Response::HTTP_UNAUTHORIZED
        );
        //END test not logged in
    }

    public function testInvalidCreateMissingVal()
    {
        //test missing val
        $response = $this->actingAs(self::$user)
            ->postJson(route('shake.reaction.store', self::$shake), ['val' => '']);
        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
        $response->assertJsonValidationErrors('val');
        //END test missing val
    }

    public function testInvalidCreateInvalidVal(){
        //test invalid val
        $response = $this->actingAs(self::$user)
            ->postJson(route('shake.reaction.store', self::$shake), ['val' => 'wef']);
        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
        $response->assertJsonValidationErrors('val');
        //END test missing val
    }

    public function testValidCreate(){
        foreach([-1, 0, 1] as $reaction) {
            $response = $this
                ->actingAs(self::$user)
                ->postJson(route('shake.reaction.store', self::$shake), ['val' => $reaction]);
            $response->assertOk();
            $response->assertJsonMissingValidationErrors('val');
        }
    }
}
