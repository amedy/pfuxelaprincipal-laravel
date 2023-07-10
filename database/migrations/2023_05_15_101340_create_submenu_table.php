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
        Schema::create('submenu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('menu');
            $table->string('nome');
            $table->string('route');
            $table->tinyInteger('sidebar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submenu');
    }
};
