<?php

namespace App\Http\Controllers\Dashboard\Configuracion\Estados;

use App\Http\Controllers\Controller;
use App\Models\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CiudadesController extends Controller
{
    var $request,$model,$folder = "dashboard.configuracion.estados.ciudades";
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->model = new Ciudad();
    }

    public function index($estado=true) {
        return view($this->folder.'.index',[
            'jsControllers'=>[
                0 => 'app/dashboard/configuracion/estados/ciudades/HomeController.js'
            ],
            'estado' => $estado
        ]);
    }
    
    public function all($estado) {
       return $this->model->where('estado_id',$estado)->get();
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
    
    public function show($id) {
         $itemData = $this->model->find($id);
         if($itemData) {
              return $this->successResponse($itemData);
          } else {
              return $this->errorResponse([
                     'err' => true,
                     'message' => 'No existe el elemento solicitado.'
              ]);
          }
    }
    
    public function destroy($id) {
      try {
         DB::beginTransaction();
         $itemData = $this->model->find($id);
         if($itemData) {
           if($itemData->delete()) {
              DB::commit();
              return $this->successResponse([
                     'err' => false,
                     'message' => 'Registro eliminado correctamente.'
              ]);
           } else {
              return $this->errorResponse([
                     'err' => true,
                     'message' => 'No ha sido posible eliminar registro, por favor intente dentro de un momento más.'
              ]);
           }
         } else {
          DB::rollback();
          return $this->errorResponse([
            'err' =>true,
            'message' => 'No ha sido posible eliminar registro, por favor intente dentro de un momento más.'
          ]);
         }
      }
       catch(\Exception $e){
          echo $e->getMessage();
          DB::rollback();
          return $this->errorResponse([
            'err' =>true,
            'message' => 'No ha sido posible eliminar registro.'
          ]);
       }
    }

    function enable_all($id) {
      $this->model->where('estatus',0)->where('estado_id',$id)->get()->map(function($state){
          $state->estatus = 1;
          $state->save();
          return $state;
      });
      return $this->successResponse([
          'err'=>false,
          'message'=> 'Acción realiada correctamente.'
      ]);
    }

    function disable_all($id) {
        $this->model->where('estatus',1)->where('estado_id',$id)->get()->map(function($state){
            $state->estatus = 0;
            $state->save();
            return $state;
        });
        return $this->successResponse([
            'err'=>false,
            'message'=> 'Acción realiada correctamente.'
        ]);
    }
}
