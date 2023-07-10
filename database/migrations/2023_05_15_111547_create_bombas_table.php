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
        Schema::create('bombas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->enum('tipo', ['Interna', 'Externa']);
            $table->integer('capacidade')->nullable();
            $table->integer('minima')->nullable();
            $table->integer('disponivel')->nullable();
            $table->enum('estado', ['Disponível', 'Indisponível']);
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
        Schema::dropIfExists('bombas');
    }
};
