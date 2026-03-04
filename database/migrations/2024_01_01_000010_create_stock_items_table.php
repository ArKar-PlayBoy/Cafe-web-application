<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('current_quantity')->default(0);
            $table->integer('min_quantity')->default(10);
            $table->string('barcode')->nullable()->unique();
            $table->string('bin_location')->nullable();
            $table->enum('category', ['ingredient', 'supply'])->default('ingredient');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_items');
    }
};
