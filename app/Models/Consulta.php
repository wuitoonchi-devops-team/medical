<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $table = "consultas";
    protected $fillable = [
        'paciente_id',
        'motivo',
        'peso',
        'talla',
        'imc',
        'temperatura',
        'arterial_sistole',
        'arterial_diastole',
        'arterial_frecuencia',
        'frecuencia_respiratoria',
        'circunferencia_abdominal',
        'tratamiento',
        'pronostico_ligado_evolucion',
        'receta',
        'controlados',
        'laboratorios',
        'rayosx',
        'interconsulta',
        'indicaciones',
        'electrocardiograma',
        'incapacidad',
        'constancia_asistencia',
        'cuidados_maternos',
        'citologia_cerv_vaginal',
        'preparados',
        'estudios_especiales',
        'estudios_audiologicos',
        'sugerir_cirugia',
        'proc_urologia',
        'proc_hematologia',
        'valoracion_preanestecia',
        'contrareferencia'
    ];

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }
}
