<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rota_motorista', function (Blueprint $table) {
            $server = DB::connection('mysql_c')->getDatabaseName();

            $table->id();
            $table->BigInteger('rota_id')->nullable();
            // $table->foreign('rota_id')->references('id')->on($server . '.routes');
            $table->unsignedBigInteger('motorista_id')->nullable();
            $table->foreign('motorista_id')->references('id')->on('motorista');
            $table->unsignedBigInteger('alocacao_id')->nullable();
            $table->foreign('alocacao_id')->references('id')->on('viatura_alocacao');
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
        Schema::dropIfExists('rota_motorista');
    }
};
