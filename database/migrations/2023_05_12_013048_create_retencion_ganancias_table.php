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
        Schema::create('retencion_ganancias', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('tipo');
            $table->integer('minimo');
            $table->float('alicuota');
            $table->string('codigo_retencion');
            $table->string('codigo_afip');
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
        Schema::dropIfExists('retencion_ganancias');
    }
};
