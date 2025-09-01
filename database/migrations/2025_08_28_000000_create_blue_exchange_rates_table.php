<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blue_exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('source'); // URL o nombre de la fuente
            $table->decimal('rate', 16, 8); // Ej: 13.05
            $table->string('type'); // compra o venta
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blue_exchange_rates');
    }
};
