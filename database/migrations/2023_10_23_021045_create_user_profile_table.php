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
        Schema::create('user_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('firstname', 255)->nullable();
            $table->string('middlename', 255)->nullable();
            $table->string('lastname', 255)->nullable();
            $table->string('avatar_path', 255)->nullable();
            $table->string('avatar_base_url', 255)->nullable();
            $table->string('locale', 32)->nullable();
            $table->unsignedSmallInteger('gender')->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->string('jabatan', 255)->nullable();
            $table->string('kode_instansi', 255)->nullable();
            $table->string('nitk', 255)->nullable();
            $table->string('nuptk', 255)->nullable();
            $table->string('nip', 255)->nullable();
            $table->unsignedBigInteger('lpseid')->nullable();
            $table->unsignedBigInteger('isLatihan')->nullable();
            $table->string('npwp', 255)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profile');
    }
};
