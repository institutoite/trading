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
        Schema::create('official_exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('currency')->default('usd');
            $table->decimal('buy', 10, 4);
            $table->decimal('sell', 10, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('official_exchange_rates');
    }
};
