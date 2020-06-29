<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionalidadSoftwareTable extends Migration
{
      /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('funcionalidad_software', function (Blueprint $table) {
            $table->unsignedBigInteger('software_id');

            $table->foreign('software_id', 'software_id_fk_99999')->references('id')->on('software')->onDelete('cascade');

            $table->unsignedBigInteger('funcionalidad_id');

            $table->foreign('funcionalidad_id', 'funcionalidad_id_fk_99999')->references('id')->on('funcionalidad')->onDelete('cascade');

           
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
        Schema::dropIfExists('funcionalidad_software');
    }
}
