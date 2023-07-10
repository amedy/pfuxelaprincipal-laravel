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
        Schema::create('viatura_estado', function (Blueprint $table) {
            $table->id();
            $table->double('combustivel_disponivel', 18, 2);
            $table->integer('odometro_anterior');
            $table->integer('odometro');
            $table->enum('localizacao', ['Dentro', 'Fora']);
            $table->unsignedBigInteger('viatura_id');
            $table->foreign('viatura_id')->references('id')->on('viatura');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('user');
            $table->timestamps();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viatura_estado');
    }
};
