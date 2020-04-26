<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additionals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_id')->unsigned();
            $table->double('value', 10, 2)->nullable();
            $table->dateTime('date')->nullable();
            $table->timestamps();
            $table->bigInteger('user')->unsigned();
            $table->boolean('remove')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additionals');
    }
}
