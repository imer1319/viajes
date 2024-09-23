<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastoChofersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gasto_chofers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('numero_interno')->unique();
            $table->date('fecha');
            $table->foreignId('proveedor_id')->constrained('proveedors');
            $table->decimal('importe', 15, 2);
            $table->decimal('saldo', 15, 2);
            $table->foreignId('chofer_id')->constrained('chofers');
            $table->foreignId('flota_id')->constrained('flotas');
            $table->text('detalle');
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
        Schema::dropIfExists('gasto_chofers');
    }
}
