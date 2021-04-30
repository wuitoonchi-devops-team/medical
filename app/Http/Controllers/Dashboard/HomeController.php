<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Paciente;
use App\Models\Consulta;
use Carbon\Carbon;

class HomeController extends Controller
{
    var $request;
    var $model;
    var $folder='dashboard';
    var $path;
    public function __construct(Request $request) {
       $this->request = $request;
       $this->path = str_replace('.','/',$this->folder);
    }

    public function index($index=null) {
       return view($this->folder.'.index',[
        'jsControllers'=>[
          0 => 'app/'.$this->path.'/HomeController.js',
          1 => 'app/'.$this->path.'/GraficasController.js',
        ],
        'cssStyles' => [
            0 => 'app/'.$this->path.'/style.css'
        ]
       ]);
    }

    public function graficasPacientes($fechaInicial,$fechaFinal){
      
      $activos = 0;
      $inactivos = 0;
      $ninos = 0;
      $jovenes = 0;
      $mayores = 0;
      $sexo_masculino = 0;
      $sexo_femenino = 0;
      
      $pacientes = Paciente::select(['nacimiento', 'sexo', 'estatus'])
                      ->whereDate('created_at', ">=", $fechaInicial)
                      ->whereDate('created_at', "<=", $fechaFinal)
                      ->get();

      foreach ($pacientes as $item) {
          
          // DETERMINAR PACIENTE POR ESTATUS
          switch ($item->estatus) {
              case 1: $activos += 1; break;
              case 0: $inactivos += 1; break;
          }
          
          // DETERMINAR PACIENTE POR EDAD
          $edad = Carbon::parse($item->nacimiento)->age;
          switch ($edad) {
              case $edad >= 0 && $edad <= 15: $ninos += 1; break;
              case $edad >= 16 && $edad <=50: $jovenes += 1; break;
              case $edad >= 51: $mayores += 1; break;
          }
          
          // DETERMINAR PACIENTE POR SEXO
          switch ($item->sexo) {
              case 'M': $sexo_masculino += 1; break;
              case 'F': $sexo_femenino += 1; break;
          }
      }

      return [
          "ninos"         => $ninos,
          "jovenes"       => $jovenes,
          "mayores"       => $mayores,
          "activos"       => $activos,
          "inactivos"     => $inactivos,
          "masculino"    => $sexo_masculino,
          "femenino"      => $sexo_femenino
      ];
    
    }

    public function graficasConsultas($fechaInicial,$fechaFinal){
        
        // DETERMINAR NÚMERO DE CONSULTAS POR FECHA
        $consultas_fecha = Consulta::select(DB::raw('count(id) as cantidad, date(created_at) as fecha'))
                            ->whereDate("created_at", ">=", $fechaInicial)
                            ->whereDate("created_at", "<=", $fechaFinal)
                            ->groupBy('fecha')
                            ->get();
        
        return [
            "consultas_fecha" => $consultas_fecha,
        ];
    }
}
