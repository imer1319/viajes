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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social');
            $table->string('cuit');
            $table->string('domicilio');
            $table->string('numero_ingreso_bruto');
            $table->foreignId('condicion_iva_id')->constrained("condicion_ivas");
            $table->string('telefono');
            $table->string('celular');
            $table->foreignId('provincia_id')->constrained("provincias");
            $table->foreignId('departamento_id')->constrained("departamentos");
            $table->foreignId('localidad_id')->constrained("localidades");
            $table->string('codigo_postal');
            $table->string('email');
            $table->string('contacto');
            $table->foreignId('retencion_ingreso_bruto_id')->constrained("retencion_ingresos_brutos");
            $table->foreignId('plan_cuenta_id')->constrained('plan_cuentas');
            $table->foreignId('retencion_ganancia_id')->constrained("retencion_ganancias");
            $table->bigInteger('saldo')->default(0);
            $table->boolean('estado');
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
        Schema::dropIfExists('proveedors');
    }
};
