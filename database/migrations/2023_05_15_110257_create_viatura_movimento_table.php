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
        Schema::create('viatura_movimento', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['Entrada', 'Saída']);
            $table->integer('odometro_registado');
            $table->double('combustivel_registado', 18, 2);
            $table->unsignedBigInteger('plano_viagem_id')->nullable();
            $table->foreign('plano_viagem_id')->references('id')->on('plano_viagem');
            $table->unsignedBigInteger('viatura_id');
            $table->foreign('viatura_id')->references('id')->on('viatura');
            $table->unsignedBigInteger('motorista_id');
            $table->foreign('motorista_id')->references('id')->on('motorista');
            $table->timestamps();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viatura_movimento');
    }
};
