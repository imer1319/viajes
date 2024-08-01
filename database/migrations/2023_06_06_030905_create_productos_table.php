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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->foreignId('categoria_id')->nullable()->constrained('categorias');
            $table->decimal('precio_compra', 10, 2);
            $table->decimal('precio_venta', 10, 2);
            $table->string('stock_minimo');
            $table->string('alicuota');
            $table->enum('estado',['activo','pasivo']);
            $table->foreignId('marca_id')->constrained('marcas');
            $table->foreignId('rubro_id')->constrained('rubros');
            $table->boolean('compra');
            $table->boolean('vende');
            $table->boolean('stockeable');
            $table->foreignId('retencion_ganancia_id')->constrained('retencion_ganancias');
            $table->foreignId('retencion_ingreso_bruto_id')->constrained('retencion_ingresos_brutos');
            $table->date('fecha_ultima_venta')->nullable();
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
        Schema::dropIfExists('productos');
    }
};
