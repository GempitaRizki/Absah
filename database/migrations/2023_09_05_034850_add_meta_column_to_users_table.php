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
        Schema::table('users', function (Blueprint $table) {
            $table->string('company')->nullable()->change();
            $table->renameColumn('company', 'jabatan');
            $table->renameColumn('address1', 'NIP');
            $table->renameColumn('address2', 'NIK');
            $table->dropColumn('province_id');
            $table->dropColumn('city_id');
            $table->dropColumn('postcode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
