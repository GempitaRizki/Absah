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
        Schema::create('bank_store', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('number')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->string('kode_bank')->nullable();
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('master_status');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('bank_id')->references('id')->on('master_bank');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_bank_store');
    }
};
