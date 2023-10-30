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
        Schema::create('user_address', function (Blueprint $table) {
            $table->id();
            $table->string('label', 50)->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('districts_id')->nullable();
            $table->unsignedBigInteger('subdistrict_id')->nullable();
            $table->unsignedBigInteger('village_id')->nullable();
            $table->string('village_name', 100)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('sekolah_id')->nullable();

            $table->foreign('province_id')->references('id')->on('province');
            $table->foreign('districts_id')->references('id')->on('districts');
            $table->foreign('subdistrict_id')->references('id')->on('subdistricts');
            $table->foreign('village_id')->references('id')->on('village');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('master_status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_address');
    }
};
