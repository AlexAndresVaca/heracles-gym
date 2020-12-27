<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medidas', function (Blueprint $table) {
            $table->id('cod_med');
            $table->float('peso_med', 8, 2)->nullable();
            $table->float('talla_med', 8, 2)->nullable();
            $table->float('biceps_med', 8, 2)->nullable();
            $table->float('triceps_med', 8, 2)->nullable();
            $table->float('cintura_med', 8, 2)->nullable();
            $table->float('pantorrillas_med', 8, 2)->nullable();
            $table->float('muslo1_med', 8, 2)->nullable();
            $table->float('muslo2_med', 8, 2)->nullable();
            $table->float('espaldaH_med', 8, 2)->nullable();
            $table->float('pectoralH_med', 8, 2)->nullable();
            $table->float('toraxM_med', 8, 2)->nullable();
            $table->float('caderaM_med', 8, 2)->nullable();
            $table->float('muslo3M_med', 8, 2)->nullable();
            $table->float('gluteosM_med', 8, 2)->nullable();
            $table->string('fk_ci_cli_med');
            $table->foreign('fk_ci_cli_med')->references('ci_cli')->on('clientes');
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
        Schema::dropIfExists('medidas');
    }
}
