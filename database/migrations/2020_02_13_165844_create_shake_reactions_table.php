<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShakeReactionsTable extends Migration
{
    const TBL_NAME = 'shake_reactions';
    const FOR_KEY = 'shake_id';
    const FOR_KEY2 = 'user_id';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this::TBL_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger($this::FOR_KEY)->unsigned()->index();
            $table->unsignedBigInteger($this::FOR_KEY2)->unsigned()->index();
            $table->string('val');
            $table->foreign($this::FOR_KEY)->references('id')->on('shakes')->onDelete('cascade');
            $table->foreign($this::FOR_KEY2)->references('id')->on('users')->onDelete('cascade');
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
