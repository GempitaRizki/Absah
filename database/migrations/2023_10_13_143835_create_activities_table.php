<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('type', 255)->nullable();
            $table->text('message')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->string('action', 255)->nullable();
            $table->longText('agregasi_json')->nullable();
            $table->unsignedBigInteger('agregasi_status')->nullable();
            $table->text('endpoint')->nullable();
            $table->string('type_agregasi', 255)->nullable();
            $table->text('metadata')->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->string('ip', 255)->nullable();
            $table->text('ipinfo')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->dateTime('dateUTC')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
