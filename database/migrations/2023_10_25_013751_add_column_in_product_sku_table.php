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
            $table->string('kode_kbki', 255)->after('height_packing')->nullable();
            $table->string('nomorsk', 255)->after('kode_kbki')->nullable();
            $table->string('tanggal_sk', 255)->after('nomorsk')->nullable();
            $table->decimal('tkdn', 15)->after('tanggal_sk')->nullable();
            $table->decimal('bmp', 15)->after('tkdn')->nullable();

            $table->smallInteger('status_ongkir')->unsigned()->nullable();
            $table->bigInteger('madein')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_sku', function (Blueprint $table) {
            $table->dropColumn('kode_kbki');
            $table->dropColumn('nomorsk');
            $table->dropColumn('tanggal_sk');
            $table->dropColumn('madein');
            $table->dropColumn('status_ongkir');
            $table->dropColumn('tkdn');
            $table->dropColumn('bmp');

        });
    }
};
