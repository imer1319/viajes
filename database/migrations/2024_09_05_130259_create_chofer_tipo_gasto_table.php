<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoferTipoGastoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chofer_tipo_gasto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gasto_chofer_id')->constrained('gasto_chofers')->onDelete('cascade');
            $table->foreignId('tipo_gasto_id')->constrained('tipo_gastos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chofer_tipo_gasto');
    }
}
