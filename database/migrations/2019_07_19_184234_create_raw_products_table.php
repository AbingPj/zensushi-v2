<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item')->unsigned();
            $table->bigInteger('raw')->unsigned();
            $table->double('value', 10, 2);
            $table->boolean('remove')->nullable()->default(false);
            $table->timestamps();
            $table->foreign('item')->references('id')->on('items')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_products');
    }
}
