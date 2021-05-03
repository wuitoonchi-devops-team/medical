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
        'tratamiento',
        'receta',
        'laboratorios',
        'rayosx',
        'indicaciones'
    ];

    public function paciente() {
        return $this->belongsTo(Paciente::class, "paciente_id", "id")->withTrashed();
    }
}
