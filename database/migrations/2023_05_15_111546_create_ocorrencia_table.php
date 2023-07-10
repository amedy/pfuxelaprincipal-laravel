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
        Schema::create('ocorrencia', function (Blueprint $table) {
            $table->id();
            $table->longText('descricao');
            $table->dateTime('data_hora');
            $table->enum('tipo', ['Informativa', 'Acção Necessária']);
            $table->integer('odometro');
            $table->unsignedBigInteger('motorista_id');
            $table->foreign('motorista_id')->references('id')->on('motorista');
            $table->unsignedBigInteger('viatura_id');
            $table->foreign('viatura_id')->references('id')->on('viatura');
            $table->unsignedBigInteger('movimento_id')->nullable();
            $table->foreign('movimento_id')->references('id')->on('viatura_movimento');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('user');
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
        Schema::dropIfExists('ocorrencia');
    }
};
