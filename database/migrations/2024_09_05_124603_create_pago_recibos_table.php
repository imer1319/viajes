<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_recibos', function (Blueprint $table) {
            $table->id();
            $table->string('nro')->nullable();
            $table->foreignId('recibo_id')->constrained('recibos');
            $table->foreignId('forma_pago_id')->constrained('formas_pagos');
            $table->foreignId('banco_id')->nullable()->constrained('bancos');
            $table->decimal('importe', 15, 2);
            $table->date('fecha_emision')->nullable();
            $table->date('fecha_vencimiento')->nullable();
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
        Schema::dropIfExists('pago_recibos');
    }
}
