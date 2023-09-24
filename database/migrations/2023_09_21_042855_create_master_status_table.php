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
        Schema::create('master_status', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('name_alias')->nullable();
            $table->text('descriptions')->nullable();
            $table->unsignedBigInteger('label_status')->nullable();
            $table->unsignedBigInteger('is_status')->nullable();
            $table->unsignedBigInteger('is_visible')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_status');
    }
};