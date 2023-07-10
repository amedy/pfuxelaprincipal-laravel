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
        Schema::create('viatura_alocacao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('viatura_id')->nullable();
            $table->foreign('viatura_id')->references('id')->on('viatura');
            $table->unsignedBigInteger('motorista_id')->nullable();
            $table->foreign('motorista_id')->references('id')->on('motorista');
            $table->integer('distancia_estimativa');
            $table->double('combustivel_estimativa', 18, 2);
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
        Schema::dropIfExists('viatura_alocacao');
    }
};
