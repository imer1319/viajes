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
        Schema::create('remitos', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('proveedor_id')->constrained('proveedors');
            $table->foreignId('localidad_id')->constrained('localidades');
            $table->dateTime('fecha_ingreso');
            $table->enum('estado',['pendiente', 'parcial', 'completado'])->default('pendiente');
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
        Schema::dropIfExists('remitos');
    }
};
