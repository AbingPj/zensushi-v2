<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScrapsRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scraps_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigIncrements('item_id');
            $table->double('value', 10, 2)->nullable();
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
        Schema::dropIfExists('scraps_records');
    }
}
