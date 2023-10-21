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
        Schema::create('courier_product', function (Blueprint $table) {
            $table->id();
            $table->string('code', 45)->nullable();
            $table->string('name', 45)->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('courier_partner_id')->nullable();
            $table->string('service', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courier_product');
    }
};
