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
        Schema::table('sekolah', function (Blueprint $table) {
            $table->renameColumn('prov', 'provinsi');
            $table->renameColumn('kab', 'kota');
            $table->renameColumn('kec', 'kecamatan');
            $table->renameColumn('desa', 'kelurahan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sekolah', function (Blueprint $table) {
            $table->renameColumn('provinsi', 'prov');
            $table->renameColumn('kota', 'kab');
            $table->renameColumn('kecamatan', 'kec');
            $table->renameColumn('kelurahan', 'desa');
        });
    }
};
