<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use App\Models\Paciente;
use App\Models\Estado;
use App\Models\Ciudad;
use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use PDF;

class ConsultasController extends Controller
{
    var $request;
    var $model;
    var $folder='dashboard.consultas';
    var $path;
    public function __construct(Request $request) {
       $this->request = $request;
       $this->path = str_replace('.','/',$this->folder);
       $this->model = new Consulta();
    }

    public function index($index=null) {
       return view($this->folder.'.index',[
            'pacientes' => Paciente::where('estatus',1)->with(["consultas"])->get(),
            'jsControllers'=>[
               0 => 'app/'.$this->path.'/HomeController.js',
            ],
            'cssStyles' => [
               0 => 'app/'.$this->path.'/style.css'
            ]
       ]);
    }

    public function datatable() {
        return DataTables::of(Consulta::all())
                  ->addColumn("afiliacion", function(Consulta $consulta){
                     return $consulta->paciente->afiliacion;
                  })
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

    // METODO PARA IMPRIMIR LA CONSULTA DEL PACIENTE
    public function imprimirConsulta($id){
      $consulta = Consulta::where("id", $id)->with(["paciente"])->get();
      
      
      $fecha = Carbon::now();

      $f1 = $fecha->toDateString();
      $f11 = explode("-", $f1);
      $f12 = $f11[0].$f11[1].$f11[2];

      $f2 = $fecha->toTimeString();
      $f21 = explode(":", $f2);
      $f22 = $f21[0].$f21[1].$f21[2];
        
      $nombre = "consulta-" . $f12 . $f22;

      // CALCULAR LA EDAD
      if($consulta[0]->paciente->nacimiento !== NULL){
         $edad = Carbon::parse($consulta[0]->paciente->nacimiento)->age;
      }
      else{
         $edad = "N/A";
      }
      
      // DETERMINAR EL ESTADO Y LA CIUDAD
      $estado = Estado::find($consulta[0]->paciente->estado_id);
      $ciudad = Ciudad::find($consulta[0]->paciente->ciudad_id);

      // DETERMINAR FECHA Y HORA
      $datetime = Carbon::parse($consulta[0]->created_at);
      $f = $datetime->toDateString();
      $hora = $datetime->toTimeString();

      $fecha = explode("-", $f);

      $extra = [
         "edad"   => $edad,
         "estado" => $estado,
         "ciudad" => $ciudad,
         "fecha"  => $fecha[2]."-".$fecha[1]."-".$fecha[0],
         "hora"   => $hora 
      ];
      $configuracion = Configuracion::first();
      // save - Para guardarlo
      // stream - Para mostrarlo en el navegador
      // download - Para descargarlo

      $pdf = PDF::loadView('dashboard.pdfs.imprimir-consulta', 
      [
         "consulta" => $consulta, 
         "extra" => $extra,
         "configuracion" => $configuracion]);
	   return $pdf->stream($nombre . '.pdf');
    }
}
