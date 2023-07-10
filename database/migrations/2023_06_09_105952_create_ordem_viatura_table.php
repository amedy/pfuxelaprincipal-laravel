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
        Schema::create('ordem_viatura', function (Blueprint $table) {
            $table->id();
            $table->double('combustivel_abastecer', 18, 2);
            $table->double('combustivel_estimativa', 18, 2);
            $table->integer('distancia_estimativa');
            $table->integer('distancia_calculada');
            $table->enum('periodo', ['Manhã', 'Tarde']);
            $table->string('justificacao')->nullable();
            $table->double('preco_total', 18, 2);
            $table->unsignedBigInteger('ordem_id')->nullable();
            $table->foreign('ordem_id')->references('id')->on('ordem');
            $table->unsignedBigInteger('viatura_id')->nullable();
            $table->foreign('viatura_id')->references('id')->on('viatura');
            $table->timestamps();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordem_viatura');
    }
};
