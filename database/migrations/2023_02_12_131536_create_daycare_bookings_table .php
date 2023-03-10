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
        Schema::create('daycare_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('daycare_enrollment_id');
            $table->date('date');
            $table->time('entry_time');
            $table->time('exit_time')->nullable();
            $table->integer('extra_time')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daycare_bookings');
    }
};
