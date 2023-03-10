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
        Schema::create('dewormers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sevice_reference_id')->nullable();
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            $table->foreignId('veterinarian_id')->constrained()->onDelete('cascade');
            $table->date('given_date');
            $table->float('weight');
            $table->string('medication');
            $table->date('reinforcement_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dewormers');
    }
};
