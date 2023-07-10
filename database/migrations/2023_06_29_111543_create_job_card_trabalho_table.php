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
        Schema::create('job_card_trabalho', function (Blueprint $table) {
            $table->id();
            $table->longText('descricao_trabalho');
            $table->dateTime('data_hora_inicio_1');
            $table->dateTime('data_hora_fim_1');
            $table->dateTime('data_hora_inicio_2')->nullable();
            $table->dateTime('data_hora_fim_2')->nullable();
            $table->unsignedBigInteger('job_card_id');
            $table->foreign('job_card_id')->references('id')->on('job_card');
            $table->unsignedBigInteger('tecnico_id');
            $table->foreign('tecnico_id')->references('id')->on('tecnico');
            $table->unsignedBigInteger('tecnico_2_id')->nullable();
            $table->foreign('tecnico_2_id')->references('id')->on('tecnico');
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
        Schema::dropIfExists('job_card_trabalho');
    }
};
