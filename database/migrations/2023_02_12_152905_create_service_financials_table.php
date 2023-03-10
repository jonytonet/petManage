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
        Schema::create('service_financials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_reference_id')->constrained('sevice_references');
            $table->foreignId('service_type_id')->constrained();
            $table->double('service_value', 8, 2);
            $table->foreignId('payment_method_id')->constrained();
            $table->double('discount', 8, 2)->nullable();
            $table->double('additional_expenses', 8, 2)->nullable();
            $table->double('commission_value', 8, 2)->nullable();
            $table->double('net_total', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_financials');
    }
};
