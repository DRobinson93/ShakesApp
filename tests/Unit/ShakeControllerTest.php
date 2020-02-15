<?php

namespace Tests\Unit;

use App\User;
use App\Shake;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ShakeControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    protected static $user;

    public function setUp() :void
    {
        parent::setUp();
        self::$user = factory(User::class)->create();
    }

    public function testInvalidCreate()
    {
        $response = $this
            ->actingAs(self::$user)
            ->postJson(route('shake.store'), [
                'title' => '',
                'ingredients' => [['id'=>1, 'val' =>$this->faker->word()], []]
            ]);
        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
        $response->assertJsonValidationErrors('title');
        $response->assertJsonValidationErrors('ingredients.1.val');//the second ing is empty
    }

    public function testStore()
    {
        $postData = [
            'title' => $this->faker->word(),
            'ingredients' => [['val' =>$this->faker->word()], ['val' =>$this->faker->word()]]
        ];
        $response = $this
            ->actingAs(self::$user)
            ->postJson(route('shake.store'), $postData);
        $response->assertOk();
        //make sure id is sent back
        $this->assertNotNull($response->json('id'));
        //verify exists in db
        $this->assertDatabaseHas('shakes', ['id' => $response->json('id'), 'title' => $postData['title']]);
        foreach($postData['ingredients'] as $ingVal) {
            $this->assertDatabaseHas('shake_ingredients', ['shake_id' => $response->json('id'), 'val' => $ingVal]);
        }
        return Shake::with('ingredients')->where('id', $response->json('id'))->first();
    }

    public function testIndex(){
        $response = $this->call('GET', route('home'));
        $response->assertOk();
        $response->assertViewHas('shakes');
        $response->assertSee('Shakes');
    }

    public function testShow(){
        $shake = factory(Shake::class)->create();
        $response = $this->call('GET', route('shake.show', $shake));
        $response->assertOk();
        $response->assertViewHas('shake');
        $response->assertSee('Shakes');
        $response->assertSee($shake->title);
        foreach($shake->ingredients as $ing) {
            $response->assertSee($ing->val);
        }
    }

    public function testDestroy()
    {
        $shake = $this->testStore();
        $response = $this
            ->actingAs(self::$user)
            ->delete(route('shake.destroy', $shake));
        $response->assertOk();
        $this->assertDatabaseMissing('shakes', ['id' => $shake->id, 'title' => $shake->title]);
        foreach($shake->ingredients as $ingVal) {
            $this->assertDatabaseMissing('shake_ingredients', ['shake_id' => $shake->id, 'val' => $ingVal]);
        }
    }
}
