<?php

use App\Enums\StatusEnum;
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
        Schema::create('plots', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->decimal('area', 10, 2);
            $table->string('crop_type');
            $table->dateTime('plantation_date');
            $table->enum('status', StatusEnum::values());
            $table->timestamps();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();

            // Assurer l'unicité du nom de la parcelle par utilisateur
            $table->unique(['name', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plots');
    }
};
