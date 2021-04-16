<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ciudad;
use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{

    var $request;
    var $model;
    public function __construct(Request $request) {
       $this->request = $request;
       $this->model = new Estado();
    }

    public function index($id=null) {
        return Estado::where('estatus',1)->get();
    }

    public function ciudades($estado) {
        return Ciudad::where([
            'estatus' => 1,
            'estado_id' => $estado
            ])->get();
    }
}
