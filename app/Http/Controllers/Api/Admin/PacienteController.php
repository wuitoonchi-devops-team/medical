<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Paciente;

class PacienteController extends Controller
{
    var $request;
    var $model;
    public function __construct(Request $request) {
       $this->request = $request;
       $this->model = new Paciente();
    }

    public function index($id=null) {
            return $this->successResponse($id!=null?$this->model->find($id)
            ->map(function($paciente) {
                $paciente->estado; $paciente->ciudad; return $paciente;
            }):$this->model->all()
            ->map(function($paciente) {
                $paciente->estado; $paciente->ciudad; return $paciente;
            }));
    }

}
