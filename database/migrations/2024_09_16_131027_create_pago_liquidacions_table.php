<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoLiquidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_liquidacions', function (Blueprint $table) {
            $table->id();
            $table->string('nro')->nullable();
            $table->foreignId('liquidacion_id')->constrained('liquidacions');
            $table->foreignId('forma_pago_id')->constrained('formas_pagos');
            $table->foreignId('banco_id')->nullable()->constrained('bancos');
            $table->decimal('importe', 15, 2);
            $table->date('fecha_emision')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('abreviacion');
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago_liquidacions');
    }
}
