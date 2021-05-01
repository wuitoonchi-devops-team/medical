<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use App\Models\Paciente;
use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use Codedge\Fpdf\Facades\Fpdf;
use Codedge\Fpdf\Fpdf\Fpdf as FpdfFpdf;

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
      $configuracion = Configuracion::first();
      $pdf =  new FpdfFpdf();
      $pdf->AddPage();
      // Logo
      $pdf->Image($configuracion->logo,10,8,30);
      $pdf->AddFont('PinyonScript','','PinyonScript-Regular.php');
      $pdf->SetFont('PinyonScript','',20);
      $pdf->Cell(80);
      $pdf->Cell(30,10,$configuracion->medico,0,0,'C');
      $pdf->Ln(7);
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(80);
      $pdf->Cell(30,10,$configuracion->institucion,0,0,'C');
      $pdf->SetFont('Arial','B',10);
      $pdf->Ln(5);
      $pdf->Cell(80);
      $pdf->Cell(30,10,$configuracion->especializacion,0,0,'C');
      $pdf->Ln(4);
      $pdf->SetFont('Arial','',8);
      $pdf->Cell(80);
      $pdf->Cell(30,10,$configuracion->direccion,0,0,'C');
      $pdf->Ln(4);
      $pdf->SetFont('Arial','',8);
      $pdf->Cell(80);
      $pdf->Cell(30,10,'TEL. CONSULTORIO: '.$configuracion->tels,0,0,'C');
      $pdf->Ln(4);
      $pdf->SetFont('Arial','',8);
      $pdf->Cell(80);
      $pdf->Cell(30,10,'CONSULTA:'.$configuracion->horario,0,0,'C');
      //Body
      $pdf->Ln(20);
      $pdf->SetFont('Courier', 'B', 18);
      $pdf->Cell(50, 25, 'Hello World!');
      return $pdf->Output();
    }
}
