<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_item_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->decimal('cost', 10, 2)->nullable();
            $table->date('received_date')->useCurrent();
            $table->date('expiry_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_batches');
    }
};
