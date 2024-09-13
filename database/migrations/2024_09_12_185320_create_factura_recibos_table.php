<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_recibos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factura_id')->constrained('cliente_facturas');
            $table->foreignId('recibo_id')->constrained('recibos');
            $table->decimal('pago', 15, 2);
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
        Schema::dropIfExists('factura_recibos');
    }
}
