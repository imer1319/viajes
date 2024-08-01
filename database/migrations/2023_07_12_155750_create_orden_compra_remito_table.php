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
        Schema::create('orden_compra_remito', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_compra_id')->constrained('orden_compras')->cascadeOnDelete();
            $table->foreignId('remito_id')->constrained('remitos')->cascadeOnDelete();
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
        Schema::dropIfExists('orden_compra_remito');
    }
};
