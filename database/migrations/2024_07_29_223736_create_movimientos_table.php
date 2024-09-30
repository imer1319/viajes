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
            $table->bigInteger('numero_interno')->unique();
            $table->date('fecha');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('tipo_viaje_id')->constrained('tipo_viajes');
            $table->text('detalle');
            $table->string('numero_factura_1');
            $table->string('numero_factura_2');
            $table->decimal('precio_real', 15, 2)->nullable();
            $table->bigInteger('iva');
            $table->decimal('total', 15, 2);
            $table->decimal('saldo_total', 15, 2);
            $table->foreignId('flota_id')->constrained('flotas');
            $table->foreignId('chofer_id')->constrained('chofers');
            $table->bigInteger('precio_chofer')->nullable();
            $table->integer('porcentaje_pago');
            $table->decimal('comision_chofer', 10, 2);
            $table->decimal('saldo_comision_chofer', 15, 2);
            $table->boolean('facturado')->default(0);
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
