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
        Schema::create('abastecimento', function (Blueprint $table) {
            $table->id();
            $table->string('referencia');
            $table->unsignedBigInteger('bombas_id');
            $table->foreign('bombas_id')->references('id')->on('bombas');
            $table->unsignedBigInteger('ordem_id');
            $table->foreign('ordem_id')->references('id')->on('ordem');
            $table->unsignedBigInteger('action_by')->nullable();
            $table->foreign('action_by')->references('id')->on('user');
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
        Schema::dropIfExists('abastecimento');
    }
};
