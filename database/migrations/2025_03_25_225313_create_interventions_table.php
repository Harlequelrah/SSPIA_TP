<?php

use App\Enums\InterventionTypeEnum;
use App\Enums\UnitEnum;
use App\Models\Plot;
use App\Models\User;
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
        Schema::create('interventions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('description')->nullable();
            $table->string('product_used_name')->nullable();
            $table->decimal('product_used_quantity')->nullable();
            $table->enum('intervention_type', InterventionTypeEnum::values());
            $table->enum('unit', UnitEnum::values());
            $table->dateTime('intervention_date');
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('plot_id')->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
