<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Consulta;

class ConsultaController extends Controller
{
    var $request;
    var $model;
    public function __construct(Request $request) {
       $this->request = $request;
       $this->model = new Consulta();
    }
}
