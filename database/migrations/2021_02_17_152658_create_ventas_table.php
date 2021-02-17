<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('cod_ven');
            $table->string('descripcion_ven')->nullable();
            $table->integer('cantidad_ven')->default(1);
            $table->unsignedBigInteger('fk_cod_prod_ven');
            $table->foreign('fk_cod_prod_ven')->references('cod_prod')->on('productos');
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
        Schema::dropIfExists('ventas');
    }
}
