<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use HasFactory, SoftDeletes;
    protected $table="pacientes";
    protected $fillable = [
        'afiliacion',
        'nombre',
        'sexo',
        'nacimiento',
        'edad',
        'alergias',
        'enfermedades_cronica',
        'estado_id',
        'ciudad_id',
        'estatus'
    ];

    public function estado() {
        return $this->belongsTo(Estado::class,'estado_id');
    }
    public function ciudad() {
        return $this->belongsTo(Ciudad::class,'ciudad_id');
    }

    public function consultas(){
        return $this->hasMany(Consulta::class, 'id', 'paciente_id');
    }
}
