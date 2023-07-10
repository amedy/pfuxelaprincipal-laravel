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
        Schema::create('viatura_anexo', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('ficheiro_tipo');
            $table->string('path');
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
        Schema::dropIfExists('viatura_anexo');
    }
};
