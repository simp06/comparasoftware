<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Funcionalidad;

class CreateFuncionalidadTable extends Migration
{
    public function up()
    {
        Schema::create('funcionalidad', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('nombre')->nullable();
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
        Schema::dropIfExists('funcionalidad');
    }
}

