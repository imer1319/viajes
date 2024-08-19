<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidacionMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidacion_movimientos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('importe', 10, 2);
            $table->foreignId('chofer_id')->constrained('chofers');
            $table->foreignId('movimiento_id')->constrained('movimientos');
            $table->foreignId('liquidacion_id')->constrained('liquidacions');
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
        Schema::dropIfExists('liquidacion_movimientos');
    }
}
