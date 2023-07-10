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
        Schema::create('peca_guia_entrega', function (Blueprint $table) {
            $table->id();
            $table->string('observacoes');
            $table->unsignedBigInteger('peca_requisicao_id');
            $table->foreign('peca_requisicao_id')->references('id')->on('peca_requisicao');
            $table->unsignedBigInteger('delivered_by');
            $table->foreign('delivered_by')->references('id')->on('user');
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
        Schema::dropIfExists('peca_guia_entrega');
    }
};
