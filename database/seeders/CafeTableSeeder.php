<?php

namespace Database\Seeders;

use App\Models\CafeTable;
use Illuminate\Database\Seeder;

class CafeTableSeeder extends Seeder
{
    public function run(): void
    {
        $tables = [
            ['table_number' => 'T1', 'capacity' => 2],
            ['table_number' => 'T2', 'capacity' => 2],
            ['table_number' => 'T3', 'capacity' => 4],
            ['table_number' => 'T4', 'capacity' => 4],
            ['table_number' => 'T5', 'capacity' => 4],
            ['table_number' => 'T6', 'capacity' => 6],
            ['table_number' => 'T7', 'capacity' => 6],
            ['table_number' => 'T8', 'capacity' => 8],
            ['table_number' => 'T9', 'capacity' => 8],
            ['table_number' => 'T10', 'capacity' => 8],
        ];
        foreach ($tables as $table) {
            CafeTable::create($table);
        }
    }
}
