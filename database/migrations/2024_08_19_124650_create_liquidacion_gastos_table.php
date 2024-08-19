<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidacionGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidacion_gastos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chofer_id')->constrained('chofers');
            $table->foreignId('liquidacion_id')->constrained('liquidacions');
            $table->foreignId('gasto_id')->constrained('gasto_chofers');
            $table->decimal('importe', 10, 2);
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
        Schema::dropIfExists('liquidacion_gastos');
    }
}
