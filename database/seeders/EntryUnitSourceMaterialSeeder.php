<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EntryUnitSourceMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('entry_unit_source_material')->insert([
            [
                'source_material_id' => 1, 
                'entry_unit_id' => 1,
            ],
            [
                'source_material_id' => 1, 
                'entry_unit_id' => 2,
            ],
        ]);
    }
}
