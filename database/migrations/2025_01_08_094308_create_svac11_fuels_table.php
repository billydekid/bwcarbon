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
        Schema::create('svac11_fuels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_svac11_id')->constrained()->cascadeOnDelete();
            $table->foreignId('source_material_id')->constrained();
            $table->foreignId('brand_material_id')->constrained();
            $table->foreignId('material_usage_id')->constrained();
            $table->foreignId('service_account_id')->constrained();
            $table->decimal('consumption', $precision = 12, $scale = 4);
            $table->foreignId('entry_unit_id')->constrained();
            $table->decimal('emission', $precision = 18, $scale = 4);
            $table->decimal('error_margin_pct', $precision = 7, $scale = 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('svac11_fuels');
    }
};
