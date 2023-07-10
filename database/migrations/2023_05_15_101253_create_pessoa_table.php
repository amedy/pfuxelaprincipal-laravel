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
        Schema::create('pessoa', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('apelido');
            $table->date('data_nascimento');
            $table->unsignedBigInteger('genero_id');
            $table->foreign('genero_id')->references('id')->on('genero');
            $table->unsignedBigInteger('estado_civil_id')->nullable();
            $table->foreign('estado_civil_id')->references('id')->on('estado_civil');
            $table->unsignedBigInteger('tipo_documento_id')->nullable();
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento');
            $table->string('numero_documento')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable()->nullable();
            $table->foreign('categoria_id')->references('id')->on('categoria');
            $table->unsignedBigInteger('departamento_id')->nullable()->nullable();
            $table->foreign('departamento_id')->references('id')->on('departamento');
            $table->integer('nuit')->nullable();
            $table->integer('inss')->nullable();
            $table->string('morada')->nullable();
            $table->integer('contacto');
            $table->integer('contacto_alt')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('user');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('user');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('user');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoa');
    }
};
