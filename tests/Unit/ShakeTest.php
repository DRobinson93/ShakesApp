<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use \App\Shake;
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
}
