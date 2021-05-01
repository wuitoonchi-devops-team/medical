<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class PacienteConsultasController extends Controller
{
    var $request;
    var $model;
    var $folder='dashboard.pacientes.consultas';
    var $path;
    public function __construct(Request $request) {
       $this->request = $request;
       $this->path = str_replace('.','/',$this->folder);
       $this->model = new Consulta();
    }

    public function index($index=null) {
       return view($this->folder.'.index',[
            'data' => Paciente::find($index),
            'jsControllers'=>[
               0 => 'app/'.$this->path.'/HomeController.js',
            ],
            'cssStyles' => [
                  0 => 'app/'.$this->path.'/style.css'
            ]
       ]);
    }

    public function datatable($id) {
       $consultas = Consulta::where("paciente_id",$id)->get();

       return DataTables::of($consultas)
                  ->addColumn("nombre", function(Consulta $consulta){
                     return $consulta->paciente->nombre;
                  })   
                  ->make(true);
    }

    
    public function store() {
      try {
         DB::beginTransaction();
         $data = $this->request->all();
         //echo response()->json($data);
         $this->model->fill($data)->save();
         DB::commit();
         return $this->successResponse([
              'err' => false,
              'message' => 'Datos registrados correctamente.',
              'id_consulta' => $this->model->id
         ]);
      }
       catch(\Exception $e){
          echo $e->getMessage();
          DB::rollback();
          return $this->errorResponse([
            'err' =>true,
            'message' => 'No ha sido posible crear registro, por favor verifique su información e intente nuevamente.'
          ]);
       }
    }

    public function update($id) {
      try {
         DB::beginTransaction();
         $data = $this->request->all();
         $data['pronostico_ligado_evolucion'] = isset($data['pronostico_ligado_evolucion'])?1:0;
         $data['receta'] = isset($data['receta'])?1:0;
         $data['rayosx'] = isset($data['rayosx'])?1:0;
         $data['interconsulta'] = isset($data['interconsulta'])?1:0;
         $data['indicaciones'] = isset($data['indicaciones'])?1:0;
         $data['electrocardiograma'] = isset($data['electrocardiograma'])?1:0;
         $data['incapacidad'] = isset($data['incapacidad'])?1:0;
         $data['constancia_asistencia'] = isset($data['constancia_asistencia'])?1:0;
         $data['cuidados_maternos'] = isset($data['cuidados_maternos'])?1:0;
         $data['citologia_cerv_vaginal'] = isset($data['citologia_cerv_vaginal'])?1:0;
         $data['preparados'] = isset($data['preparados'])?1:0;
         $data['estudios_especiales'] = isset($data['estudios_especiales'])?1:0;
         $data['estudios_audiologicos'] = isset($data['estudios_audiologicos'])?1:0;
         $data['sugerir_cirugia'] = isset($data['sugerir_cirugia'])?1:0;
         $data['proc_urologia'] = isset($data['proc_urologia'])?1:0;
         $data['proc_hematologia'] = isset($data['proc_hematologia'])?1:0;
         $data['valoracion_preanestecia'] = isset($data['valoracion_preanestecia'])?1:0;
         $data['contrareferencia'] = isset($data['contrareferencia'])?1:0;
         $itemData = $this->model->find($id);
         if($itemData){
           if($itemData->fill($data)->isDirty()) {
              $itemData->save();
              DB::commit();
              return $this->successResponse([
                     'err' => false,
                     'message' => 'Datos actualizados correctamente.'
              ]);
           } else {
              return $this->successResponse([
                     'err' => false,
                     'message' => 'Ningún dato ha cambiado.'
              ]);
           }
         } else {
          DB::rollback();
          return $this->errorResponse([
            'err' =>true,
            'message' => 'No ha sido posible editar registro, por favor verifique su información e intente nuevamente.'
          ]);
         }
      }
       catch(\Exception $e){
          echo $e->getMessage();
          DB::rollback();
          return $this->errorResponse([
            'err' =>true,
            'message' => 'No ha sido posible editar registro, por favor verifique su información e intente nuevamente.'
          ]);
       }
    }

    public function buscar_paciente() {
       return Paciente::where('nombre','like','%'.request()->input('search').'%')->get();
    }
}
