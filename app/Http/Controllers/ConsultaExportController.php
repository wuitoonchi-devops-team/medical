<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ConsultasExport;
use App\Exports\ConsultasPacienteExport;

class ConsultaExportController extends Controller
{
    public function exportConsultas(){
        $nombre = "consultas-listado-".rand(100000,999999).".xlsx"; 
        return Excel::download(new ConsultasExport, $nombre);
    }

    public function exportConsultasPaciente($id){
        $nombre = "consultas-paciente-".rand(100000,999999).".xlsx"; 
        return Excel::download(new ConsultasPacienteExport($id), $nombre);
    }
}
