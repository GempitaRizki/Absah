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
        Schema::create('user_sekolah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sekolah_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('status')->nullable();
            $table->string('kode_wilayah')->nullable();
            $table->string('nama')->nullable();
            $table->string('nik')->nullable();
            $table->string('nip')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('pengguna_id')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('peran')->nullable();
            $table->string('peran_id')->nullable();
            $table->string('sekolah_id_json')->nullable();
            $table->string('username')->nullable();
            $table->unsignedBigInteger('status_beku')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sekolah');
    }
};
