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
        Schema::create('faktur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->string('no_faktur', 150)->nullable();
            $table->unsignedBigInteger('status')->nullable();
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->string('status_faktur', 255)->nullable();
            $table->decimal('dpp', 10)->nullable();
            $table->unsignedBigInteger('ppn')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('kode_faktur', 5)->nullable();
            $table->string('npwp', 255)->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faktur');
    }
};
