<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('record')->unsigned();
            // $table->bigInteger('item')->unsigned();
            $table->double('value', 10, 2)->nullable();
            // $table->boolean('remove')->nullable()->default(false);
            $table->timestamps();
            $table->foreign('record')->references('id')->on('records')->onDelete('cascade');
            // $table->foreign('item')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bones');
    }
}
