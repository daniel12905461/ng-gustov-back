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
        Schema::create('dia_laborals', function (Blueprint $table) {
            $table->id();
            $table->boolean('Domingo');
            $table->boolean('Lunes');
            $table->boolean('Martes');
            $table->boolean('Miercoles');
            $table->boolean('Jueves');
            $table->boolean('Viernes');
            $table->boolean('Sabado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dia_laborals');
    }
};
