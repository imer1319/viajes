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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social');
            $table->string('domicilio');
            $table->string('cuit');
            $table->bigInteger('numero_ingreso_bruto');
            $table->foreignId('condicion_iva_id')->constrained('condicion_ivas');
            $table->string('telefono');
            $table->string('celular')->nullable();
            $table->foreignId('provincia_id')->constraint('provincia');
            $table->foreignId('departamento_id')->constraint('departamentos');
            $table->foreignId('localidad_id')->constraint('localidades');
            $table->string('codigo_postal');
            $table->string('email')->unique()->nullable();
            $table->string('contacto');
            $table->foreignId('retencion_ganancia_id')->constrained('retencion_ganancias');
            $table->foreignId('retencion_ingreso_bruto_id')->constrained('retencion_ingresos_brutos');
            $table->foreignId('tipo_documento_id')->constrained('tipo_documentos');
            $table->string('numero_documento');
            $table->bigInteger('saldo')->default(0);
            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO');
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
        Schema::dropIfExists('clientes');
    }
};
