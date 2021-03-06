<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShakesTable extends Migration
{
    const TBL_NAME = 'shakes';
    const FOR_KEY = 'user_id';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this::TBL_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedBigInteger($this::FOR_KEY)->unsigned()->index();
            $table->foreign($this::FOR_KEY)->references('id')->on('users')->onDelete('cascade');
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
        Schema::table($this::TBL_NAME, function (Blueprint $table) {
            $table->dropForeign([$this::FOR_KEY]);
        });
        Schema::dropIfExists($this::TBL_NAME);
    }
}
