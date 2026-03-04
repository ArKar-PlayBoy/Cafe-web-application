<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_item_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_item_id')->constrained()->onDelete('cascade');
            $table->foreignId('stock_item_id')->constrained()->onDelete('cascade');
            $table->integer('quantity_needed')->default(1);
            $table->timestamps();

            $table->unique(['menu_item_id', 'stock_item_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_item_stock');
    }
};
