<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ScopeSeeder::class,
            ServiceAccountSeeder::class,
            EntryPeriodSeeder::class,
            PeriodListSeeder::class,
            EntryMeasurementSeeder::class,
            EntryUnitSeeder::class,
            DataActivitySeeder::class,
            SourceMaterialSeeder::class,
            BrandMaterialSeeder::class,
            MaterialUsageSeeder::class,
            ServiceAccountSourceMaterialSeeder::class,
            EntryUnitSourceMaterialSeeder::class,
        ]);
    }
}
