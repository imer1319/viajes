<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_interno');
            $table->date('fecha');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('tipo_viaje_id')->constrained('tipo_viajes');
            $table->text('detalle');
            $table->string('numero_factura_1');
            $table->string('numero_factura_2');
            $table->bigInteger('precio_real');
            $table->bigInteger('iva');
            $table->bigInteger('total');
            $table->bigInteger('saldo_total');
            $table->foreignId('flota_id')->constrained('flotas');
            $table->foreignId('chofer_id')->constrained('chofers');
            $table->bigInteger('precio_chofer');
            $table->integer('porcentaje_pago');// default 16%
            $table->integer('comision_chofer'); // CALCULO precio_chofer * porcnetaje pago
            $table->bigInteger('saldo_comision_chofer');
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
        Schema::dropIfExists('movimientos');
    }
}
