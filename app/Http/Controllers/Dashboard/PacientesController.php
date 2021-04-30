<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
class PacientesController extends Controller
{
    var $request;
    var $model;
    var $folder='dashboard.pacientes';
    var $path;
    public function __construct(Request $request) {
       $this->request = $request;
       $this->path = str_replace('.','/',$this->folder);
       $this->model = new Paciente();
    }

    public function index($index=null) {
       return view($this->folder.'.index',[
        'jsControllers'=>[
          0 => 'app/'.$this->path.'/HomeController.js',
        ],
        'cssStyles' => [
            0 => 'app/'.$this->path.'/style.css'
        ]
       ]);
    }

    public function datatable() {
        return DataTables::of(Paciente::all())
                     ->addColumn('edad', function(Paciente $paciente){
                        $edad = Carbon::parse($paciente->nacimiento)->age;
                        return $edad;
                     })
                     ->make(true);
    }

    
    public function store() {
      try {
         DB::beginTransaction();
         $data = $this->request->all();
         $existe = $this->model->where('afiliacion',$data['afiliacion'])->first();
         if($existe) {
            if($existe->afiliacion!=null) {
               return $this->errorResponse([
                  'err' => true,
                  'message' => 'Ya existe un paciente con la misma serie de afiliación'
               ]);
            }
         }
         //echo response()->json($data);
         $this->model->fill($data)->save();
         DB::commit();
         return $this->successResponse([
              'err' => false,
              'message' => 'Datos registrados correctamente.'
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
         $itemData = $this->model->find($id);
         $existe = $this->model->where('afiliacion',$data['afiliacion'])->first();
         if($existe->id!=$id) {
            if($existe->afiliacion!=null) {
               return $this->errorResponse([
                  'err' => true,
                  'message' => 'Ya existe un paciente con la misma serie de afiliacióin'
               ]);
            }
         }
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
}
