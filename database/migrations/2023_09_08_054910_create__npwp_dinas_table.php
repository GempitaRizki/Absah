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
        Schema::create('NpwpDinas', function (Blueprint $table) {
            $table->id();
            $table->string('npwp')->nullable();
            $table->string('npwp_dinas')->nullable();
            $table->string('nama_dinas')->nullable();
            $table->string('order_id')->nullable();
            $table->string('alamat_dinas')->nullable();
            $table->string('sekolah_id')->nullable();
            $table->string('used_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('NpwpDinas');
    }
};