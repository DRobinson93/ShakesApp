<?php

namespace Tests\Unit;

use App\Shake;
use App\ShakeReaction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ShakeReactionTest extends TestCase
{
    use RefreshDatabase;
    const TABLE_NAME = 'shake_reactions';
    /**
     * A basic unit test example.
     *
     * @return void
     */
    //store update
    public function testCanCreate()
    {
        $reaction = factory(ShakeReaction::class)->make();
        $this->assertTrue($reaction->save());
        $this->assertDatabaseHas($this::TABLE_NAME, ['id' => $reaction->id]);
    }

    public function testHasCorrectCols(){
        $this->assertTrue(
            Schema::hasColumns($this::TABLE_NAME,
                $this->getColsWithShared(['user_id', 'shake_id', 'val'])
            )
        );
    }

    public function testHasAnShake()
    {
        $reaction = factory(ShakeReaction::class)->create();

        $this->assertInstanceOf(Shake::class,$reaction->shake);
        $this->assertEquals(1, $reaction->shake->count());
    }

    public function testHasAnUser()
    {
        $reaction = factory(ShakeReaction::class)->create();

        $this->assertInstanceOf(User::class,$reaction->user);
        $this->assertEquals(1, $reaction->shake->count());
    }
}
