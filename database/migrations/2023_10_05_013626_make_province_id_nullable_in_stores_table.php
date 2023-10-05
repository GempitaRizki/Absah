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
        Schema::table('stores', function (Blueprint $table) {
            $table->unsignedBigInteger('province_id')->nullable()->change();
            $table->unsignedBigInteger('district_id')->nullable()->change();
            $table->unsignedBigInteger('subdistrict_id')->nullable()->change();
            $table->unsignedBigInteger('village_id')->nullable()->change();
            $table->unsignedBigInteger('status_id')->nullable()->change();                
            $table->unsignedBigInteger('seller_type')->references('id')->on('master_status')->change();


        });
    }

    /**s
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            //
        });
    }
};
