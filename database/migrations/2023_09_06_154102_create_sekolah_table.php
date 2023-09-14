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
        Schema::create('sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('data_sekolah')->nullable();
            $table->string('data_pengguna')->nullable();
            $table->string('sekolah')->nullable();
            $table->string('alamat')->nullable();
            $table->string('bendahara_bos')->nullable();
            $table->string('bentuk_pendidikan')->nullable();
            $table->string('bujur')->nullable();
            $table->string('desa')->nullable();
            $table->string('email')->nullable();
            $table->string('kab')->nullable();
            $table->string('kec')->nullable();
            $table->string('kepala_sekolah')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('lintang')->nullable();
            $table->string('nama_sekolah')->nullable();
            $table->string('nip_bendahara_bos')->nullable();
            $table->string('nip_kepala_sekolah')->nullable();
            $table->string('no_sekolah')->nullable();
            $table->string('npsn')->nullable();
            $table->string('npwp_dinas')->nullable();
            $table->string('prov')->nullable();
            $table->string('sekolah_id')->nullable();
            $table->string('status')->nullable();
            $table->string('zona')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah');
    }
};