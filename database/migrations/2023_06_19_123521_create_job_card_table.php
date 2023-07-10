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
        Schema::create('job_card', function (Blueprint $table) {
            $table->id();
            $table->string('referencia');
            $table->integer('codigo');
            $table->longText('descricao_diagnostico');
            $table->longText('causa_avaria');
            $table->unsignedBigInteger('ocorrencia_id')->nullable();
            $table->foreign('ocorrencia_id')->references('id')->on('ocorrencia');
            $table->unsignedBigInteger('viatura_id');
            $table->foreign('viatura_id')->references('id')->on('viatura');
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
        Schema::dropIfExists('job_card');
    }
};
