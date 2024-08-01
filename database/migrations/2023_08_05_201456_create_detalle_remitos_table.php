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
        Schema::create('detalle_remitos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained();
            $table->foreignId('orden_compra_id')->nullable()->constrained('orden_compras');
            $table->foreignId('remito_id')->constrained('remitos')->cascadeOnDelete();
            $table->foreignId('centro_costo_id')->nullable()->constrained();
            $table->foreignId('deposito_id')->nullable()->constrained();
            $table->foreignId('ubicacion_id')->nullable()->constrained();
            $table->integer('cantidad_pendiente');
            $table->integer('cantidad');
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
        Schema::dropIfExists('detalle_remitos');
    }
};
