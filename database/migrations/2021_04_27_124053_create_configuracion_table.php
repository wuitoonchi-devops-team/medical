<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->default(env('DEFAULT_LOGO'));
            $table->string('medico')->nullable();
            $table->string('especializacion')->nullable();
            $table->string('institucion')->nullable();
            $table->string('direccion')->nullable();
            $table->string('tels')->nullable();
            $table->string('horario')->nullable();
            $table->string('rfc')->nullable();
            $table->string('dgp')->nullable();
            $table->string('regss')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('configuracion');
    }
}
