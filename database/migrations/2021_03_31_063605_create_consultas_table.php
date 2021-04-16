<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->string('motivo')->nullable();
            $table->float('peso')->nullable();
            $table->float('talla')->nullable();
            $table->float('imc')->nullable();
            $table->float('arterial_sistole')->nullable();
            $table->float('arterial_diastole')->nullable();
            $table->integer('arterial_frecuencia')->nullable();
            $table->float('temperatura')->nullable();
            $table->float('frecuencia_respiratoria')->nullable();
            $table->float('circunferencia_abdominal')->nullable();
            $table->mediumText('tratamiento')->nullable();
            $table->boolean('pronostico_ligado_evolucion')->default(0);
            $table->boolean('receta')->default(0);
            $table->boolean('controlados')->default(0);
            $table->boolean('laboratorios')->default(0);
            $table->boolean('rayosx')->default(0);
            $table->boolean('interconsulta')->default(0);
            $table->boolean('indicaciones')->default(0);
            $table->boolean('electrocardiograma')->default(0);
            $table->boolean('incapacidad')->default(0);
            $table->boolean('constancia_asistencia')->default(0);
            $table->boolean('cuidados_maternos')->default(0);
            $table->boolean('citologia_cerv_vaginal')->default(0);
            $table->boolean('preparados')->default(0);
            $table->boolean('estudios_especiales')->default(0);
            $table->boolean('estudios_audiologicos')->default(0);
            $table->boolean('sugerir_cirugia')->default(0);
            $table->boolean('proc_urologia')->default(0);
            $table->boolean('proc_hematologia')->default(0);
            $table->boolean('valoracion_preanestecia')->default(0);
            $table->boolean('contrareferencia')->default(0);
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
        Schema::dropIfExists('consultas');
    }
}
