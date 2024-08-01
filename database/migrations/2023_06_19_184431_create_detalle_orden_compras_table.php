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
        Schema::create('detalle_orden_compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_compra_id')->constrained('orden_compras');
            $table->foreignId('producto_id')->constrained('productos');
            $table->decimal('precio_compra', 10, 2);
            $table->integer('cantidad');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('subtotal_impuestos', 10, 2);
            $table->integer('cantidad_pendiente');
            $table->integer('cantidad_baja')->default(0);
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
        Schema::dropIfExists('detalle_orden_compras');
    }
};
