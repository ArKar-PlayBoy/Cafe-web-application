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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_reference')->nullable()->after('payment_status');
            $table->string('payment_screenshot')->nullable()->after('payment_reference');
            $table->text('payment_note')->nullable()->after('payment_screenshot');
            $table->timestamp('payment_verified_at')->nullable()->after('payment_note');
            $table->unsignedBigInteger('payment_verified_by')->nullable()->after('payment_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_reference',
                'payment_screenshot',
                'payment_note',
                'payment_verified_at',
                'payment_verified_by',
            ]);
        });
    }
};
