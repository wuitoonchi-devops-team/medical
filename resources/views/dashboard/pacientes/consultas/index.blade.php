@extends('dashboard.layout.main')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de consultas | <b>{{ $data->nombre }}</b></h6>
        <button class="btn btn-info float-right" style="margin-top: -25px;" data-toggle="modal" data-target="#mdlNew" title="Agregar consulta a {{ $data->nombre }}"><i class="fa fa-plus-circle"></i></button>
        <form action="{{ route('export-consultas-paciente', ["id" => $data->id]) }}" method="GET" enctype="multipart/form-data" id="formExportarExcel"><button type="submit" class="btn btn-success float-right" id="btnExportarExcel" style="margin-top: -25px;margin-right:1px;" title="Exportar a Excel de {{ $data->nombre }}"><i class="fa fa-file-excel"></i></button></form>
    </div>
    
    <div class="card-body">
        <input type="hidden" id="paciente_id" value="{{ $data->id }}">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Motivo</th>
                        <th width="150">Fecha</th>
                        <th width="80">Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<!-- Logout Modal-->
<form id="frmNew">
    <div class="modal fade" id="mdlNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo consulta</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('dashboard.pacientes.consultas.form')
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i></button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Editar -->
<form id="frmEdit">
    <div class="modal fade" id="mdlEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar consulta</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('dashboard.pacientes.consultas.form')
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i></button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection