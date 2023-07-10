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
        Schema::create('ordem', function (Blueprint $table) {
            $table->id();
            $table->string('referencia');
            $table->integer('codigo');
            $table->enum('tipo', ['Normal', 'Extraordinária'])->default('Normal');
            $table->enum('estado', ['Aberta', 'Autorizada', 'Cancelada', 'Pendente'])->default('Pendente');
            $table->enum('objectivo', ['Rota', 'Teste de estrada', 'Especial', 'Reposição de combustível', 'Apoio', 'Compra de Peças', 'Serviços Administrativos'])->default('Rota');
            $table->double('combustivel_total', 18, 2);
            $table->string('destino')->nullable();
            $table->string('observacao')->nullable();
            $table->unsignedBigInteger('bombas_id');
            $table->foreign('bombas_id')->references('id')->on('bombas');
            $table->unsignedBigInteger('plano_viagem_id')->nullable();
            $table->foreign('plano_viagem_id')->references('id')->on('plano_viagem');
            $table->unsignedBigInteger('action_by')->nullable();
            $table->foreign('action_by')->references('id')->on('user');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('user');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('user');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('user');
            $table->timestamp('action_at')->nullable();
            $table->timestamps();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordem');
    }
};
