<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftwareLenguajeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('lenguaje_software', function (Blueprint $table) {
            $table->unsignedBigInteger('software_id');

            $table->foreign('software_id', 'software_id_fk_9999')->references('id')->on('software')->onDelete('cascade');

            $table->unsignedBigInteger('lenguaje_id');

            $table->foreign('lenguaje_id', 'lenguaje_id_fk_9999')->references('id')->on('lenguaje')->onDelete('cascade');

           
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
        Schema::dropIfExists('lenguaje_software');
    }
}
