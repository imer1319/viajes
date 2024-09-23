<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_facturas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->decimal('neto', 10, 2);
            $table->decimal('iva', 10, 2);
            $table->decimal('total', 10, 2);
            $table->decimal('saldo_total', 10, 2);
            $table->string('observaciones')->nullable();
            $table->string('numero_interno');
            $table->string('numero_factura_1');
            $table->string('numero_factura_2');
            $table->foreignId('condiciones_pago_id')->constrained('condiciones_pagos');
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
        Schema::dropIfExists('cliente_facturas');
    }
}
