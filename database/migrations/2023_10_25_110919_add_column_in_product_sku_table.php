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
            $table->string('qty_min', 255)->nullable()->after('made_in');
            $table->string('qty_max' , 255)->nullable()->after('qty_max');
            $table->string('' , 255)->nullable()->after('made_in');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_sku', function (Blueprint $table) {
            $table->dropColumn('min_qty');
        });
    }
};
