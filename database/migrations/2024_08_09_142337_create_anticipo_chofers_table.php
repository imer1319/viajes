<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnticipoChofersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anticipo_chofers', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_interno');
            $table->date('fecha');
            $table->foreignId('chofer_id')->constrained('chofers');
            $table->bigInteger('importe');
            $table->bigInteger('saldo');
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
        Schema::dropIfExists('anticipo_chofers');
    }
}
