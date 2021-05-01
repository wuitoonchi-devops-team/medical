@extends('dashboard.layout.main')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de pacientes</h6>
        <button class="btn btn-info float-right" style="margin-top: -25px;" data-toggle="modal" data-target="#mdlNew"><i class="fa fa-plus-circle"></i></button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th width="1">Alergias</th>
                        <th width="1">Cronica</th>
                        <th width="1">Edad</th>
                        <th width="1">Sexo</th>
                        <th width="1">Estatus</th>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo paciente</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('dashboard.pacientes.form')
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar paciente</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('dashboard.pacientes.form')
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