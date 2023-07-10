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
        Schema::create('requisicao', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('codigo')->unique();
            $table->dateTime('data_hora_inicio');
            $table->dateTime('data_hora_fim');
            $table->string('local_origem');
            $table->string('local_destino');
            $table->integer('numero_passageiros');
            $table->longText('descricao');
            $table->enum('estado', ['Pendente', 'Respondida'])->default('Pendente');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->unsignedBigInteger('action_by')->nullable();
            $table->foreign('action_by')->references('id')->on('user');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('user');
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
        Schema::dropIfExists('requisicao');
    }
};
