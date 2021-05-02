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
      $pdf =  new FpdfFpdf('P','mm','Letter');
      $pdf->AddPage();
      // Logo
      $pdf->Image($configuracion->logo,10,8,30);
      $pdf->AddFont('PinyonScript','','PinyonScript-Regular.php');
      $pdf->SetFont('PinyonScript','',20);
      $pdf->Cell(80);
      $pdf->Cell(30,10,utf8_decode($configuracion->medico),0,0,'C');
      $pdf->Ln(7);
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(80);
      $pdf->Cell(30,10,utf8_decode($configuracion->institucion),0,0,'C');
      $pdf->SetFont('Arial','B',10);
      $pdf->Ln(5);
      $pdf->Cell(80);
      $pdf->Cell(30,10,utf8_decode($configuracion->especializacion),0,0,'C');
      $pdf->Ln(4);
      $pdf->SetFont('Arial','',8);
      $pdf->Cell(80);
      $pdf->Cell(30,10,utf8_decode($configuracion->direccion),0,0,'C');
      $pdf->Ln(4);
      $pdf->SetFont('Arial','',8);
      $pdf->Cell(80);
      $pdf->Cell(30,10,'TEL. CONSULTORIO: '.$configuracion->tels,0,0,'C');
      $pdf->Ln(4);
      $pdf->SetFont('Arial','',8);
      $pdf->Cell(80);
      $pdf->Cell(30,10,'CONSULTA:'.$configuracion->horario,0,0,'C');
      //Ids Medico
      $pdf->setXY(160, 25);
      $pdf->MultiCell(0, 4, utf8_decode('D.G.P '.$configuracion->dgp), 0, 'R');
      $pdf->setXY(160, 30);
      $pdf->MultiCell(0, 4, utf8_decode('R.F.C '.$configuracion->rfc), 0, 'R');
      $pdf->setXY(160, 35);
      $pdf->MultiCell(0, 4, utf8_decode('REG. S.S. '.$configuracion->regss), 0, 'R');
      $pdf->setXY(160, 50);
      $pdf->Line(10, 45, 205, 45);
      //Datos Paciente
         //Nombre
         $pdf->SetFont('Arial','B',9);
         $pdf->setXY(10, 48);
         $pdf->MultiCell(0, 4, utf8_decode('NOMBRE: '), 0, 'L');
         $pdf->SetFont('Arial','',9);
         $pdf->setXY(27, 48);
         $pdf->MultiCell(0, 4, utf8_decode($consulta[0]->paciente->nombre), 0, 'L');
         //Edad
         $pdf->SetFont('Arial','B',9);
         $pdf->setXY(10, 54);
         $pdf->MultiCell(13, 4, utf8_decode('EDAD: '), 0, 'R');
         $pdf->SetFont('Arial','',9);
         $pdf->setXY(21, 54);
         $pdf->MultiCell(0, 4, utf8_decode($consulta[0]->paciente->edad), 0, 'L');
         //Temp
         $pdf->SetFont('Arial','B',9);
         $pdf->setXY(30, 54);
         $pdf->MultiCell(12, 4, utf8_decode('TEMP: '), 0, 'R');
         $pdf->SetFont('Arial','',9);
         $pdf->setXY(40, 54);
         $pdf->MultiCell(0, 4, utf8_decode($consulta[0]->temperatura), 0, 'L');
         //Peso
         $pdf->SetFont('Arial','B',9);
         $pdf->setXY(50, 54);
         $pdf->MultiCell(12, 4, utf8_decode('PESO: '), 0, 'R');
         $pdf->SetFont('Arial','',9);
         $pdf->setXY(60, 54);
         $pdf->MultiCell(0, 4, utf8_decode($consulta[0]->peso.' Kg'), 0, 'L');
         //Talla
         $pdf->SetFont('Arial','B',9);
         $pdf->setXY(70, 54);
         $pdf->MultiCell(15, 4, utf8_decode('TALLA: '), 0, 'R');
         $pdf->SetFont('Arial','',9);
         $pdf->setXY(83, 54);
         $pdf->MultiCell(0, 4, utf8_decode($consulta[0]->talla), 0, 'L');
         //IMC
         $pdf->SetFont('Arial','B',9);
         $pdf->setXY(86, 54);
         $pdf->MultiCell(15, 4, utf8_decode('IMC: '), 0, 'R');
         $pdf->SetFont('Arial','',9);
         $pdf->setXY(99, 54);
         $pdf->MultiCell(0, 4, utf8_decode($consulta[0]->imc), 0, 'L');
         //P. Sitole
         $pdf->SetFont('Arial','B',9);
         $pdf->setXY(97, 54);
         $pdf->MultiCell(25, 4, utf8_decode('P. Sistole: '), 0, 'R');
         $pdf->SetFont('Arial','',9);
         $pdf->setXY(120, 54);
         $pdf->MultiCell(0, 4, utf8_decode($consulta[0]->arterial_sistole), 0, 'L');
         //P. Diastole
         $pdf->SetFont('Arial','B',9);
         $pdf->setXY(122, 54);
         $pdf->MultiCell(25, 4, utf8_decode('P. Diastole: '), 0, 'R');
         $pdf->SetFont('Arial','',9);
         $pdf->setXY(145, 54);
         $pdf->MultiCell(0, 4, utf8_decode($consulta[0]->arterial_diastole), 0, 'L');
         //Fecha
         $pdf->SetFont('Arial','B',9);
         $pdf->setXY(160, 48);
         $pdf->MultiCell(0, 4, utf8_decode('FECHA: '), 0, 'L');
         $pdf->SetFont('Arial','',9);
         $pdf->setXY(170, 48);
         $pdf->MultiCell(0, 4, Carbon::createFromTimeString($consulta[0]->created_at)->format('Y-m-d h:m a'), 0, 'R');
      $pdf->Line(10, 61, 205, 61);
      //Referido
         $recorrerX = 30;
         $recorrerY = 10;
         $pdf->SetFont('Arial','B',12);
         $pdf->setXY(10, 66);
         $pdf->MultiCell(0, 4, utf8_decode('REFERIDO A: '), 0, 'C');
         //Receta
         $pdf->SetFont('Arial','B',9);
         $pdf->setXY(10+$recorrerX, 65+$recorrerY);
         $pdf->MultiCell(0, 4, utf8_decode('RECETA: '), 0, 'L');
         $pdf->SetFont('Arial','',9);
         $pdf->setXY(25+$recorrerX, 65+$recorrerY);
         $pdf->MultiCell(0, 4, $consulta[0]->receta==1?'X':'', 0, 'L');
         //Indicaciones
         $pdf->SetFont('Arial','B',9);
         $pdf->setXY(40+$recorrerX, 65+$recorrerY);
         $pdf->MultiCell(0, 4, utf8_decode('INDICACIONES: '), 0, 'L');
         $pdf->SetFont('Arial','',9);
         $pdf->setXY(66+$recorrerX, 65+$recorrerY);
         $pdf->MultiCell(0, 4, $consulta[0]->indicaciones==1?'X':'', 0, 'L');
         //Laboratorios
         $pdf->SetFont('Arial','B',9);
         $pdf->setXY(83+$recorrerX, 65+$recorrerY);
         $pdf->MultiCell(0, 4, utf8_decode('LABORATORIOS: '), 0, 'L');
         $pdf->SetFont('Arial','',9);
         $pdf->setXY(112+$recorrerX, 65+$recorrerY);
         $pdf->MultiCell(0, 4, $consulta[0]->rayosx==1?'X':'', 0, 'L');
         //Rayos X
         $pdf->SetFont('Arial','B',9);
         $pdf->setXY(127+$recorrerX, 65+$recorrerY);
         $pdf->MultiCell(0, 4, utf8_decode('RAYOS X: '), 0, 'L');
         $pdf->SetFont('Arial','',9);
         $pdf->setXY(145+$recorrerX, 65+$recorrerY);
         $pdf->MultiCell(0, 4, $consulta[0]->rayosx==1?'X':'', 0, 'L');
      $pdf->Line(10, 73+$recorrerY, 205, 73+$recorrerY);
      //Footer
      //Body
         $pdf->SetFont('Arial','B',12);
         $pdf->setXY(10, 78+$recorrerY);
         $pdf->MultiCell(0, 4, utf8_decode('ANÁLISIS, PLAN DE ESTUDIOS Y TRATAMIENTO: '), 0, 'L');
         $pdf->SetFont('Arial','',9);
         $pdf->setXY(145+$recorrerX, 65+$recorrerY);
         $pdf->MultiCell(0, 4, $consulta[0]->rayosx==1?'X':'', 0, 'L');
         $pdf->Ln(15);
         $pdf->SetFont('Arial', '', 12);
         $pdf->MultiCell(195, 6, $consulta[0]->tratamiento);
      //Footer
         //Firma
         $pdf->SetFont('Arial','B',8);
         $pdf->Line(75, 250, 150, 250);
         $pdf->setXY(83,255);
         $pdf->MultiCell(60, 0, utf8_decode('FIRMA DEL MÉDICO'), 0, 'C');
      return $pdf->Output();
    }
}
