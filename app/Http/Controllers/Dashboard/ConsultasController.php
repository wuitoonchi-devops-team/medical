<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ConsultasController extends Controller
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

    public function datatable() {
        return datatables()->eloquent($this->model->query())->make(true);
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
         $('#frmEdit input[name=id]').val(itemData.id);
         $('#frmEdit input[name=paciente_id]').val(itemData.paciente_id);
         $('#frmEdit textarea[name=motivo]').val(itemData.motivo);
         $('#frmEdit input[name=peso]').val(itemData.peso);
         $('#frmEdit input[name=talla]').val(itemData.talla);
         $('#frmEdit input[name=imc]').val(itemData.imc);
         $('#frmEdit input[name=temperatura]').val(itemData.temperatura);
         $('#frmEdit input[name=arterial_sistole]').val(itemData.arterial_sistole);
         $('#frmEdit input[name=arterial_diastole]').val(itemData.arterial_diastole);
         $('#frmEdit input[name=arterial_frecuencia]').val(itemData.arterial_frecuencia);
         $('#frmEdit input[name=frecuencia_respiratoria]').val(itemData.frecuencia_respiratoria);
         $('#frmEdit input[name=circunferencia_abdominal]').val(itemData.circunferencia_abdominal);
         $('#frmEdit textarea[name=tratamiento]').val(itemData.tratamiento);
         $('#frmEdit input[name=pronostico_ligado_evolucion]').prop('checked',itemData.pronostico_ligado_evolucion=='1');
         $('#frmEdit input[name=receta]').prop('checked',itemData.arterial_frecuencia=='1');
         $('#frmEdit input[name=rayosx]').prop('checked',itemData.rayosx=='1');
         $('#frmEdit input[name=interconsulta]').prop('checked',itemData.interconsulta=='1');
         $('#frmEdit input[name=indicaciones]').prop('checked',itemData.indicaciones=='1');
         $('#frmEdit input[name=electrocardiograma]').prop('checked',itemData.electrocardiograma=='1');
         $('#frmEdit input[name=incapacidad]').prop('checked',itemData.incapacidad=='1');
         $('#frmEdit input[name=constancia_asistencia]').prop('checked',itemData.constancia_asistencia=='1');
         $('#frmEdit input[name=cuidados_maternos]').prop('checked',itemData.cuidados_maternos=='1');
         $('#frmEdit input[name=citologia_cerv_vaginal]').prop('checked',itemData.citologia_cerv_vaginal=='1');
         $('#frmEdit input[name=preparados]').prop('checked',itemData.preparados=='1');
         $('#frmEdit input[name=estudios_especiales]').prop('checked',itemData.estudios_especiales=='1');
         $('#frmEdit input[name=estudios_audiologicos]').prop('checked',itemData.estudios_audiologicos=='1');
         $('#frmEdit input[name=sugerir_cirugia]').prop('checked',itemData.sugerir_cirugia=='1');
         $('#frmEdit input[name=proc_urologia]').prop('checked',itemData.proc_urologia=='1');
         $('#frmEdit input[name=proc_hematologia]').prop('checked',itemData.proc_hematologia=='1');
         $('#frmEdit input[name=valoracion_preanestecia]').prop('checked',itemData.valoracion_preanestecia=='1');
         $('#frmEdit input[name=contrareferencia]').prop('checked',itemData.contrareferencia=='1');
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
