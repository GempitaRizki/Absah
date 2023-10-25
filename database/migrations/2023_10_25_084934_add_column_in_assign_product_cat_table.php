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
        Schema::table('assign_product_cat', function (Blueprint $table) {
            $table->unsignedBigInteger('product_sku')->after('parent')->nullable();
    
            $table->foreign('product_sku')->references('id')->on('product_sku');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assign_product_cat', function (Blueprint $table) {
            //
        });
    }
};
