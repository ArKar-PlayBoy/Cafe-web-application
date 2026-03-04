<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->index('status');
            $table->index('payment_status');
            $table->index('created_at');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->index('is_available');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->index('status');
            $table->index('reservation_date');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['payment_status']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropIndex(['is_available']);
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['reservation_date']);
        });
    }
};
