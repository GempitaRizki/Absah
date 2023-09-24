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
        Schema::create('store_owner', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('nik')->nullable();
            $table->string('npwp')->nullable();
            $table->string('phone_number')->nullable();
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('type');
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('type')->references('id')->on('master_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_owner');
    }
};
