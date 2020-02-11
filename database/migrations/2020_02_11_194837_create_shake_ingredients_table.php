<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShakeIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shake_ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('shake_id')->unsigned()->index();
            $table->string('val');
            $table->foreign('shake_id')->references('id')->on('shakes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shake_ingredients', function (Blueprint $table) {
            $table->dropForeign(['shake_id']);
        });
        Schema::dropIfExists('shake_ingredients');
    }
}
