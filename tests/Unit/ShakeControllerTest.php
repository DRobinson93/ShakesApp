<?php

namespace Tests\Unit;

use App\Http\Controllers\ShakeController;
use App\Shake;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;

class ShakeControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testInvalidCreate()
    {
        $response = $this
            ->postJson(route('shake.create'), [
                'title' => '',
                'ingredients' => [$this->faker->word(), '']
            ]);
        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
        $response->assertJsonValidationErrors('title');
        $response->assertJsonValidationErrors('ingredients.1');//the second ing is empty
    }

    public function testCreate()
    {
        $postData = [
            'title' => $this->faker->word(),
            'ingredients' => [$this->faker->word(), $this->faker->word()]
        ];
        $response = $this->postJson(route('shake.create'), $postData);
        $response->assertOk();
        //make sure id is sent back
        $this->assertNotNull($response->json('id'));
        //verify exists in db
        $this->assertDatabaseHas('shakes', ['id' => $response->json('id'), 'title' => $postData['title']]);
        foreach($postData['ingredients'] as $ingVal) {
            $this->assertDatabaseHas('shake_ingredients', ['shake_id' => $response->json('id'), 'val' => $ingVal]);
        }
        $postData['id'] = $response->json('id');
        return $postData;
    }

    public function testDelete()
    {
        $data = $this->testCreate();
        $response = $this
            ->postJson(route('shake.destroy'), ['id' => $data['id']]);
        $response->assertOk();
        $this->assertDatabaseMissing('shakes', ['id' => $data['id'], 'title' => $data['title']]);
        foreach($data['ingredients'] as $ingVal) {
            $this->assertDatabaseMissing('shake_ingredients', ['shake_id' => $data['id'], 'val' => $ingVal]);
        }
    }
}
