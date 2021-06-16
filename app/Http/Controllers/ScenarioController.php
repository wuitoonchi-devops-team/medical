<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf as FpdfFpdf;
class ScenarioController extends Controller
{
    public function index($index=null) {
        $pdf =  new FpdfFpdf('P','mm','Letter');
        $pdf->AddPage();

        // Logo
        //$pdf->Image(asset('logo.png'),10,8,30);
        return base64_encode($pdf->Output());
    }
}
