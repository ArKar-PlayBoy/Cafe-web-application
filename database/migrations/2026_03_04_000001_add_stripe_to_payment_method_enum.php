<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE orders MODIFY payment_method ENUM('cod', 'mpu', 'visa', 'kbz_pay', 'stripe') NOT NULL");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE orders MODIFY payment_method ENUM('cod', 'mpu', 'visa', 'kbz_pay') NOT NULL");
        }
    }
};
