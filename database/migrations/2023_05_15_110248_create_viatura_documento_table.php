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
        Schema::create('viatura_documento', function (Blueprint $table) {
            $table->id();
            $table->date('inspeccao_emissao');
            $table->date('inspeccao_validade');
            $table->date('manifesto_emissao');
            $table->date('manifesto_validade');
            $table->date('seguro_emissao');
            $table->date('seguro_validade');
            $table->date('taxa_radio_emissao');
            $table->date('taxa_radio_validade');
            $table->unsignedBigInteger('viatura_id');
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
        Schema::dropIfExists('viatura_documento');
    }
};
