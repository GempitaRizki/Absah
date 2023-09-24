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
        
            Schema::create('stores', function (Blueprint $table) {
                $table->id();
                $table->string('store_name');
                $table->unsignedBigInteger('province_id');
                $table->unsignedBigInteger('district_id');
                $table->unsignedBigInteger('subdistrict_id');
                $table->unsignedBigInteger('village_id');
                $table->string('address')->nullable();
                $table->string('postal_code')->nullable();
                $table->string('phone_number')->nullable();
                $table->string('public_email')->nullable();
                $table->string('slug')->nullable();
                $table->string('short_description')->nullable();
                $table->string('about_us')->nullable();
                $table->string('fb_name')->nullable();
                $table->string('tw_name')->nullable();
                $table->string('linked_name')->nullable();
                $table->string('web_name')->nullable();
                $table->unsignedBigInteger('status_id');
                $table->timestamps();
    
                $table->foreign('province_id')->references('id')->on('province');
                $table->foreign('district_id')->references('id')->on('districts');
                $table->foreign('subdistrict_id')->references('id')->on('subdistricts');
                $table->foreign('village_id')->references('id')->on('districts');
                $table->foreign('status_id')->references('id')->on('master_status');


            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store');
    }
};
