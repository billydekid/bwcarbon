<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaterialUsageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('material_usages')->insert([
            [
                'name' => 'Mobile Fuels',
                'code' => 'MOBILE-FUELS',
            ],
            [
                'name' => 'Stationary Fuels',
                'code' => 'STATIONARY-FUELS',
            ],
            [
                'name' => 'Total Fuels',
                'code' => 'TOTAL-FUELS',
            ],
        ]);
    }
}
