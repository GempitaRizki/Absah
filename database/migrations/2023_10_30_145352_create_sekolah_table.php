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
            $table->text('data_sekolah')->nullable();
            $table->text('data_pengguna')->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('bendahara_bos', 255)->nullable();
            $table->string('bentuk_pendidikan', 255)->nullable();
            $table->string('bujur', 255)->nullable();
            $table->string('desa', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('kab', 255)->nullable();
            $table->string('kd_kab', 255)->nullable();
            $table->string('kd_kec', 255)->nullable();
            $table->string('kd_prov', 255)->nullable();
            $table->string('kec', 255)->nullable();
            $table->string('kepala_sekolah', 255)->nullable();
            $table->string('kode_pos', 255)->nullable();
            $table->string('lintang', 255)->nullable();
            $table->string('nama_sekolah', 255)->nullable();
            $table->string('nip_bendahara_bos', 255)->nullable();
            $table->string('nip_kepala_sekolah', 255)->nullable();
            $table->string('no_telepon', 255)->nullable();
            $table->string('npsn', 255)->nullable();
            $table->string('npwp', 255)->nullable();
            $table->string('prov', 255)->nullable();
            $table->string('sekolah_id', 255)->nullable();
            $table->string('status', 255)->nullable();
            $table->string('zona', 255)->nullable();


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
