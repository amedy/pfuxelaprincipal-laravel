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
        Schema::create('viatura', function (Blueprint $table) {
            $table->id();
            $table->string('matricula');
            $table->string('nr_livrete');
            $table->string('nr_motor');
            $table->string('nr_chassi');
            $table->year('ano_fabrico');
            $table->integer('lotacao');
            $table->unsignedBigInteger('combustivel_id');
            $table->foreign('combustivel_id')->references('id')->on('combustivel');
            $table->integer('capacidade_tanque');
            $table->double('consumo_medio', 18, 2);
            $table->integer('odometro_registo');
            $table->longText('descricao');
            $table->unsignedBigInteger('marca_id');
            $table->foreign('marca_id')->references('id')->on('marca');
            $table->unsignedBigInteger('modelo_id');
            $table->foreign('modelo_id')->references('id')->on('modelo');
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('viatura_tipo');
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
        Schema::dropIfExists('viatura');
    }
};
