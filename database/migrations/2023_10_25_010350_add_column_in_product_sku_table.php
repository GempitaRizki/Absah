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
        Schema::table('product_sku', function (Blueprint $table) {
            $table->decimal('weight_packing', 11)->after('unit_weight')->nullable();
            $table->decimal('length_packing', 11)->after('weight_packing')->nullable();
            $table->decimal('width_packing', 11)->after('length_packing')->nullable();
            $table->decimal('height_packing', 11)->after('width_packing')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_sku', function (Blueprint $table) {
            //
        });
    }
};
