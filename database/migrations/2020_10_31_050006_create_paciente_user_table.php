<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacienteUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente_user', function (Blueprint $table) {
            $table->id();
$table->bigInteger("user_id")->unsigned();
$table->bigInteger("paciente_id")->unsigned();
$table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
$table->foreign("paciente_id")->references("id")->on("pacientes")->onDelete("cascade");
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
        Schema::dropIfExists('paciente_user');
    }
}
