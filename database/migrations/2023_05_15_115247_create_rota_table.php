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
        Schema::create('rota', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->enum('tipo', ['Ida', 'Volta', 'Ida e Volta']);
            $table->string('endereco');
            $table->enum('turno', ['Diurno', 'Nocturno']);
            $table->integer('distancia');
            $table->unsignedBigInteger('projecto_id');
            $table->foreign('projecto_id')->references('id')->on('projecto');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('user');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('user');
            $table->unsignedBigInteger('action_by')->nullable();
            $table->foreign('action_by')->references('id')->on('user');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('user');
            $table->timestamps();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rota');
    }
};
