<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->string('nombre');
            $table->string('apellido');
            $table->string('pais_nacimiento');
            $table->string('ciudad_nacimiento');
            $table->string('documento');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('telefono_emergencia');

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
        Schema::dropIfExists('pacientes');
    }
}
