<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->bigInteger('unit')->nullable()->unsigned();
            $table->bigInteger('category')->nullable()->unsigned();
            $table->bigInteger('item_type')->unsigned();
            $table->bigInteger('user')->unsigned();
            $table->boolean('remove')->nullable()->default(false);
            $table->timestamps();
            $table->foreign('unit')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('item_type')->references('id')->on('item_types')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
