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
        Schema::create('abastecimento_viatura', function (Blueprint $table) {
            $table->id();
            $table->double('combustivel_antes', 18, 2);
            $table->double('combustivel_abastecido', 18, 2);
            $table->double('combustivel_novo', 18, 2);
            $table->unsignedBigInteger('abastecimento_id')->nullable();
            $table->foreign('abastecimento_id')->references('id')->on('abastecimento');
            $table->timestamps();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abastecimento_viatura');
    }
};
