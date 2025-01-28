<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('service_accounts')->insert([
            [
                'name' => '1-1 Fuels Consumption',
                'code' => '1-1-FUELS-HOTEL',
                'scope_id' => 1,
            ],
            [
                'name' => '1-2 Gases Consumption',
                'code' => '1-2-GASES-HOTEL',
                'scope_id' => 1,
            ],
            [
                'name' => '1-3 Alt Fuels Consumption',
                'code' => '1-3-ALTFUELS-HOTEL',
                'scope_id' => 1,
            ],
        ]);
    }
}
