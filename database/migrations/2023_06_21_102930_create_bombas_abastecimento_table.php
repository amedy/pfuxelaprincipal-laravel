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
        Schema::create('bombas_abastecimento', function (Blueprint $table) {
            $table->id();
            $table->string('referencia');
            $table->integer('codigo');
            $table->string('factura');
            $table->integer('quantidade_anterior');
            $table->integer('quantidade_abastecida');
            $table->unsignedBigInteger('bombas_id');
            $table->foreign('bombas_id')->references('id')->on('bombas');
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
        Schema::dropIfExists('bombas_abastecimento');
    }
};
