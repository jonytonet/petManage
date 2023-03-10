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
        Schema::create('bath_and_grooming_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('pet_species');
            $table->string('fur_type');
            $table->float('max_weight');
            $table->decimal('price', 8, 2);
            $table->integer('baths_number')->nullable();
            $table->integer('max_use_months')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bath_and_grooming_plans');
    }
};
