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
        'nombre',
        'sexo',
        'edad',
        'alergias',
        'enfermedades_cronica',
        'estatus'
    ];
    public function consultas(){
        return $this->hasMany(Consulta::class, 'id', 'paciente_id');
    }
}
