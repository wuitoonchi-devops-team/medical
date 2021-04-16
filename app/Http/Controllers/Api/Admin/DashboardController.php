<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
class DashboardController extends Controller
{
    public function index($index=null) {
        // //Estadios
        // $Estadios  = Estadio::select('id', 'created_at')
        // ->whereYear('created_at', date('Y'))->get()
        // ->groupBy(function($date) {
        //     //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        //     return Carbon::parse($date->created_at)->format('m'); // grouping by months
        // });
        // $totalEstadios = 0;
        // foreach($Estadios as $key => $value) {
        //     $totalEstadios += count($value);
        // }
        // $data['estadios'] = [
        //         'total' => $totalEstadios,
        //         'data'  => $this->_getByMonth($Estadios)
        //        ];
        // //Equipos
        // $equipos  = Equipo::select('id', 'created_at')
        // ->whereYear('created_at', date('Y'))->get()
        // ->groupBy(function($date) {
        //     //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        //     return Carbon::parse($date->created_at)->format('m'); // grouping by months
        // });
        // $totalEquipos = 0;
        // foreach($equipos as $key => $value) {
        //     $totalEquipos += count($value);
        // }
        // $data['equipos' ] = [
        //         'total' => $totalEquipos,
        //         'data'  => $this->_getByMonth($equipos)
        // ];
        // //Jugadores
        // $Jugadores  = Jugador::select('id', 'created_at')
        // ->whereYear('created_at', date('Y'))->get()
        // ->groupBy(function($date) {
        //     //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        //     return Carbon::parse($date->created_at)->format('m'); // grouping by months
        // });
        // $totalJugadores = 0;
        // foreach($Jugadores as $key => $value) {
        //     $totalJugadores += count($value);
        // }
        // $data['jugadores'] = [
        //         'total' => $totalJugadores,
        //         'data'  => $this->_getByMonth($Jugadores)
        //        ];

        // return $data;
    }

    private function _getByMonth($data) {
        $arrCount = [];
        $arrData = [];

        foreach ($data as $key => $value) {
            $arrCount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++) {
            if(!empty($arrCount[$i])){
                $arrData[$i] = $arrCount[$i];
            }else{
                $arrData[$i] = 0;
            }
        }

        return $arrData;
    }
}
