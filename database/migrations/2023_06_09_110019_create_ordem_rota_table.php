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
        Schema::create('ordem_rota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ordem_viatura_id')->nullable();
            $table->foreign('ordem_viatura_id')->references('id')->on('ordem_viatura');
            $table->unsignedBigInteger('rota_id')->nullable();
            $table->timestamps();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordem_rota');
    }
};
