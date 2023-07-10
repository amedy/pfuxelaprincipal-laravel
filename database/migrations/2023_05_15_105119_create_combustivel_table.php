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
        Schema::create('combustivel', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->double('preco', 18, 2);
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('user');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combustivel');
    }
};
