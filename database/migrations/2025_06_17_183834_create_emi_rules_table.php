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
        Schema::create('emi_rules', function (Blueprint $table) {
            $table->id();
            $table->decimal('min_amount', 10, 2);
            $table->decimal('max_amount', 10, 2);
            $table->foreignId('tenure_id')->constrained('tenures');
            $table->decimal('interest_rate', 5, 2); // percentage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emi_rules');
    }
};
