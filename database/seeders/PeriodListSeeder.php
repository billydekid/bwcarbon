<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PeriodListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('period_lists')->insert([
            [
                'entry_period_id' => 1, 
                'period_value' => '2024',
            ],
            [
                'entry_period_id' => 1, 
                'period_value' => '2025',
            ],
        ]);
    }
}
