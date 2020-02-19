<?php

namespace Tests\Unit;

use App\ShakeReaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use \App\Shake;
use \App\User;
use \App\ShakeIngredient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShakeTest extends TestCase
{
    use RefreshDatabase;
    const TABLE_NAME = 'shakes';
    public function testCanCreate()
    {
        //create user using factory
        $shake = factory(Shake::class)->make();//fn create would insert
        $this->assertTrue($shake->save());
        $this->assertDatabaseHas($this::TABLE_NAME, ['id' => $shake->id]);
    }
    public function testHasCorrectCols(){
        $this->assertTrue(
            Schema::hasColumns($this::TABLE_NAME,
                $this->getColsWithShared(['title'])
            )
        );
        $this->assertFalse(
            Schema::hasColumns($this::TABLE_NAME,
                ['password', 'email_verified_at']
            )
        );
    }

    public function testHasAnIngredient()
    {
        $shake = factory(Shake::class)->create();
        //insert ingredient
        factory(ShakeIngredient::class)->create(['shake_id' => $shake->id]);

        $this->assertInstanceOf(Collection::class,$shake->ingredients);
        foreach($shake->ingredients as $ingredient)
            $this->assertInstanceOf(ShakeIngredient::class,$ingredient);

        $this->assertEquals(1, $shake->ingredients->count());
    }

    public function testHasAReaction()
    {
        $shake = factory(Shake::class)->create();
        //insert reaction
        factory(ShakeReaction::class)->create(['shake_id' => $shake->id]);

        $this->assertInstanceOf(Collection::class,$shake->reactions);
        foreach($shake->reactions as $reaction)
            $this->assertInstanceOf(ShakeReaction::class,$reaction);

        $this->assertEquals(1, $shake->reactions->count());
    }

    public function testHasAUser()
    {
        $user = factory(User::class)->create();
        //insert shake
        $shake = factory(Shake::class)->create(['user_id' => $user->id]);
        $this->assertInstanceOf(User::class,$shake->user);
        $this->assertEquals(1, $user->shakes->count());
    }
}
