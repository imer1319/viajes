<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_movimientos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->text('detalle');
            $table->bigInteger('iva');
            $table->decimal('neto', 15, 2);
            $table->decimal('total', 15, 2);
            $table->decimal('saldo_total', 15, 2);
            $table->string('numero_factura_1');
            $table->string('numero_factura_2');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('tipo_viaje_id')->constrained('tipo_viajes');
            $table->foreignId('movimiento_id')->constrained('movimientos');
            $table->foreignId('chofer_id')->constrained('chofers');
            $table->foreignId('flota_id')->constrained('flotas');
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
        Schema::dropIfExists('factura_movimientos');
    }
}
