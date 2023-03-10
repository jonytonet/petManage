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
        Schema::create('bath_and_grooming_controls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sevice_reference_id')->nullable();
            $table->foreignId('pet_id')->constrained();
            $table->foreignId('bath_and_grooming_plan_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->date('bath_date');
            $table->time('bath_time');
            $table->integer('baths_number_plan');
            $table->integer('baths_number_used')->nullable();
            $table->text('extra_services')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bath_and_grooming_controls');
    }
};
