<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            // $table->bigInteger('notification_type_id')->unsigned();
            $table->bigInteger('notification_type_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('request_id')->nullable();
            $table->bigInteger('delivery_id')->nullable();
            $table->integer('seen')->default(0);
            $table->integer('status')->default(0);
            $table->integer('remove')->default(0);
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
        Schema::dropIfExists('notifications');
    }
}
