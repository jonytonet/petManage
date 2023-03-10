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
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sevice_reference_id')->nullable();
            $table->string('name');
            $table->string('type');
            $table->date('application_date');
            $table->date('expiration_date');
            $table->text('notes')->nullable();
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            $table->foreignId('veterinarian_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccines');
    }
};
