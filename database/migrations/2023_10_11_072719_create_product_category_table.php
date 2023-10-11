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
        Schema::create('product_category', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('hierarchy', 255)->nullable();
            $table->string('hierarchy_name', 255)->nullable();
            $table->unsignedBigInteger('level')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->string('logo')->nullable();
            $table->string('bash_logo')->nullable();
            $table->string('descriptions')->nullable();
            $table->unsignedBigInteger('type_category')->nullable();
            $table->unsignedBigInteger('dikbud_type')->nullable();
            $table->unsignedBigInteger('urut')->nullable();
            $table->unsignedBigInteger('dikbud')->nullable();
            $table->string('kat_agregasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category');
    }
};
