@extends('dashboard.layout.main')
@section('content')
    <div class="card">
        <div class="card-header"><strong>Ciudades</strong>
            <button class="btn btn-dark" style="float:right; margin-left:5px" data-toggle="modal" data-target="#mdlNew" id="btnNew">Nuevo</button>
            <div class="dropdown" style="float:right; margin-left:5px;">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                    Acciones masivas
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" data-toggle="modal" id="all_enable"> Habilitar</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" id="all_disable"> Inhabilitar</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="arrData" style="width:100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th width="1">Id</th>
                    <th>Nombre</th>
                    <th width="1">Estatus</th>
                    <th width="80">Opciones</th>
                </tr>
            </thead>
            <tbody></tbody>
            </table>
        </div>
    </div>
{!! Form::model(null,['id'=>"frmNew"]) !!}
<div class="modal fade" id="mdlNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg	" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="estado_id" id="estado_id" value="{{ $estado }}">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="company">NOmbre</label>
                        <input class="form-control" id="nombre" name="nombre" type="text" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="vat">Estatus</label>
                        <select class="form-control" name="estatus" id="estatus" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>
{{ Form::close() }}

{!! Form::model(null,['id'=>"frmEdit"]) !!}
<div class="modal fade" id="mdlEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id" required>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="company">Nombre</label>
                    <input class="form-control" id="nombre" name="nombre" type="text" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="vat">Estatus</label>
                    <select class="form-control" name="estatus" id="estatus" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Editar</button>
      </div>
    </div>
  </div>
</div>
{{ Form::close() }}
@endsection
