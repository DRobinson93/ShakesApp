<?php

namespace Tests\Unit;

use App\Shake;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use \App\ShakeIngredient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShakeIngredientTest extends TestCase
{
    use RefreshDatabase;
    const TABLE_NAME = 'shake_ingredients';
    public function testCanCreate()
    {
        //create user using factory
        $shake = factory(Shake::class)->create();
        $shake = factory(ShakeIngredient::class)->make(['shake_id' => $shake->id]);//fn create would insert
        $this->assertTrue($shake->save());
        $this->assertDatabaseHas($this::TABLE_NAME, ['id' => $shake->id]);
    }

    public function testHasCorrectCols(){
        $this->assertTrue(
            Schema::hasColumns($this::TABLE_NAME,
                $this->getColsWithShared(['shake_id', 'val'])
            )
        );
    }

    public function testHasAnShake()
    {
        $shake = factory(Shake::class)->create();
        $shakeIngredient = factory(ShakeIngredient::class)->create(['shake_id' => $shake->id]);

        $this->assertInstanceOf(Shake::class,$shakeIngredient->shake);
        $this->assertEquals(1, $shakeIngredient->shake->count());
    }
}
