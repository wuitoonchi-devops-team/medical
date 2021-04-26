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
            "Nº Afiliación",
            "Nombre del Paciente",
            "Motivo",
            "Fecha",
            "Pronóstico Ligado a Evolución",
            "Peso (Kg)",
            "Talla (mts)",
            "IMC",
            "Temperatura",
            "Presión Sistole",
            "Presión Diastole",
            "Frecuencia Cardíaca",
            "Frecuencia Respiratoria",
            "C. Abdominal (cm)",
            "Tratamiento",
            "Recetas",
            "Controlados",
            "Laboratorios",
            "Rayos X",
            "Interconsulta",
            "Indicaciones",
            "Electrocardiograma",
            "Incapacidad",
            "Constancia Asistencia",
            "Cuidados Maternos",
            "Citología Cerv. Vaginal",
            "Preparados",
            "Estudios Especiales",
            "Estudios Audiológicos",
            "Sugerir Cirugía",
            "Proc. Urología",
            "Proc. Hematología",
            "Valoración Preanestecia",
            "Contrareferencia",
        ];
    }

    public function map($consulta): array
    {
        return [
            str_pad($consulta->id, 10, "0", STR_PAD_LEFT),
            $consulta->paciente->afiliacion,
            $consulta->paciente->nombre,
            $consulta->motivo,
            $consulta->created_at,
            $consulta->pronostico_ligado_evolucion === 1 ? "Sí" : "No",
            $consulta->peso,
            $consulta->talla,
            $consulta->imc,
            $consulta->temperatura,
            $consulta->arterial_sistole,
            $consulta->arterial_diastole,
            $consulta->arterial_frecuencia,
            $consulta->frecuencia_respiratoria,
            $consulta->circunferencia_abdominal,
            $consulta->tratamiento,
            $consulta->receta,
            $consulta->controlados,
            $consulta->laboratorios,
            $consulta->rayosx,
            $consulta->interconsulta,
            $consulta->indicaciones,
            $consulta->electrocardiograma,
            $consulta->incapacidad,
            $consulta->constancia_asistencia,
            $consulta->cuidados_maternos,
            $consulta->citologia_cerv_vaginal,
            $consulta->preparados,
            $consulta->estudios_especiales,
            $consulta->estudios_audiologicos,
            $consulta->sugerir_cirugia,
            $consulta->proc_urologia,
            $consulta->proc_hematologia,
            $consulta->valoracion_preanestecia,
            $consulta->contrareferencia
        ];
    }
}
