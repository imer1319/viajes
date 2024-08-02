<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flotas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('placa');
            $table->string('marca');
            $table->year('anio');
            $table->string('kilometraje');
            $table->string('identificacion');
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
        Schema::dropIfExists('flotas');
    }
}
