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
        Schema::create('peca_inventario', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade_inicial');
            $table->integer('quantidade_minima');
            $table->integer('quantidade_actual');
            $table->unsignedBigInteger('peca_id');
            $table->foreign('peca_id')->references('id')->on('peca');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('user');
            $table->timestamps();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peca_inventario');
    }
};
