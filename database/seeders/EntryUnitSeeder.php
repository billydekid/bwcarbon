<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EntryUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('entry_units')->insert([
            [
                'entry_measurement_id' => 1, 
                'unit' => 'liter',
                'is_needwpu' => false,
            ],
            [
                'entry_measurement_id' => 1, 
                'unit' => 'kiloliter',
                'is_needwpu' => false,
            ],
        ]);
    }
}
