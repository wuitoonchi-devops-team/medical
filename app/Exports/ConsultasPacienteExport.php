<?php

namespace App\Exports;

use App\Models\Consulta;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class ConsultasPacienteExport implements FromCollection, WithHeadings, WithMapping
{
    protected $id;

    public function __construct($id){
        $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Consulta::where("paciente_id",$this->id)->get();
    }

    public function headings(): array {
        return [
            "Nº Consulta",
            "Nombre del Paciente",
            "Motivo",
            "Fecha",
            "Peso (Kg)",
            "Talla (mts)",
            "IMC",
            "Temperatura",
            "Presión Sistole",
            "Presión Diastole",
            "Frecuencia Cardíaca",
            "Frecuencia Respiratoria",
            "Tratamiento",
            "Recetas",
            "Laboratorios",
            "Rayos X",
            "Indicaciones",
        ];
    }

    public function map($consulta): array
    {
        return [
            str_pad($consulta->id, 10, "0", STR_PAD_LEFT),
            $consulta->paciente->nombre,
            $consulta->motivo,
            $consulta->created_at,
            $consulta->peso,
            $consulta->talla,
            $consulta->imc,
            $consulta->temperatura,
            $consulta->arterial_sistole,
            $consulta->arterial_diastole,
            $consulta->arterial_frecuencia,
            $consulta->frecuencia_respiratoria,
            $consulta->tratamiento,
            $consulta->receta,
            $consulta->laboratorios,
            $consulta->rayosx,
            $consulta->indicaciones
        ];
    }
}
