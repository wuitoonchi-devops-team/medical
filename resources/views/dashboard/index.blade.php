@extends('dashboard.layout.main')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
    </div>
    <div class="card-body">
       <div class="row">
           <div class="col-md-3 col-12">
                <div class="form-group">
                    <label for="name">Rango de Fecha (Desde - Hasta)</label>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" id="fecharango"  name="fecharango" required>
                    </div>
                </div>
           </div> 
        </div> 
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">Consultas por Fecha</div>
                    <div class="card-body" id="contenedor_consultas_resumen">
                        <canvas id="consultas_fecha" style="width: 100%; height: 200px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">Pacientes por Estatus</div>
                    <div class="card-body" id="contenedor_pacientes_ai">
                        <canvas id="pacientes_ai" style="width: 100%; height: 200px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">Pacientes por Edad</div>
                    <div class="card-body" id="contenedor_pacientes_njm">
                        <canvas id="pacientes_njm" style="width: 100%; height: 200px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">Pacientes por Sexo</div>
                    <div class="card-body" id="contenedor_pacientes_mf">
                        <canvas id="pacientes_mf" style="width: 100%; height: 200px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection