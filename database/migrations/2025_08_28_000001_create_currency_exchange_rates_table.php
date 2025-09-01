<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('currency_exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('currency'); // Ej: EUR, ARS, CLP, etc.
            $table->string('type'); // 'buy' o 'sell'
            $table->decimal('rate', 16, 8);
            $table->timestamps();
            $table->unique(['date', 'currency', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currency_exchange_rates');
    }
};
