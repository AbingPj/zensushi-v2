<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotRawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('not_raws', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->double('value', 10, 2)->nullable();

            $table->timestamps();
            $table->boolean('remove')->nullable()->default(false);

            $table->bigInteger('item_id')->unsigned();
            // $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('not_raws');
    }
}
