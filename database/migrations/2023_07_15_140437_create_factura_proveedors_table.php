<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_proveedors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('numero');
            $table->dateTime('fecha');
            $table->foreignId('proveedor_id')->constrained('proveedors');
            $table->foreignId('IdTipoCpte')->constrained('proveedors');
            $table->string('Descripcion');
            $table->foreignId('IdCondPago')->constrained('proveedors');
           /*  Iva21
            iva105
            Iva27
            TotalPercepIva
            TotalPercep
            Total
            Nota
            FechaVto
            SaldoCpte
            Periodo */
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
        Schema::dropIfExists('factura_proveedors');
    }
};
