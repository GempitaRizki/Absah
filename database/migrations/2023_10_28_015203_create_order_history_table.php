<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHistoryTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('order_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->string('note', 255)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('type_id', 45)->nullable();
            $table->string('msg', 255)->nullable();
            $table->unsignedBigInteger('order_status_check')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('order_history');
    }
}
