@extends('dashboard.layout.main')
@section('content')
    <div class="card">
        {!! Form::model(null,['id'=>"frmEdit"]) !!}
            <div class="card-header"><strong>Configuración</strong></div>
            <div class="card-body">
                <!-- Production -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="{!! $configuracion!=null?asset($configuracion->logo):asset('assets/data/logo-default.png') !!}" id="previewDefault" class="profilePreview">
                                <hr>
                                <input type="file" name="logo" id="logo">
                                <hr>
                            </div>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="textarea-input">Institución</label>
                                            <input id="institucion" value="{{ $configuracion!=null?$configuracion->institucion:'' }}" name="institucion" rows="4" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="textarea-input">Dirección</label>
                                            <input id="direccion" value="{{ $configuracion!=null?$configuracion->direccion:'' }}" name="direccion" rows="4" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="textarea-input">Télefonos de consultorio</label>
                                            <input id="tels" value="{{ $configuracion!=null?$configuracion->tels:'' }}" name="tels" rows="4" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="textarea-input">Horario</label>
                                            <input id="horario" value="{{ $configuracion!=null?$configuracion->horario:'' }}" name="horario" rows="4" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="textarea-input">Nombre de médico</label>
                                            <input id="medico" value="{{ $configuracion!=null?$configuracion->medico:'' }}" name="medico" rows="4" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="textarea-input">Especialización</label>
                                            <input id="especializacion" value="{{ $configuracion!=null?$configuracion->especializacion:'' }}" name="especializacion" rows="4" class="form-control">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="textarea-input">D.G.P</label>
                                                    <input id="dgp" value="{{ $configuracion!=null?$configuracion->dgp:'' }}" name="dgp" rows="4" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="textarea-input">Reg. S.S</label>
                                                    <input id="regss" value="{{ $configuracion!=null?$configuracion->regss:'' }}" name="regss" rows="4" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="textarea-input">RFC</label>
                                            <input id="rfc" value="{{ $configuracion!=null?$configuracion->rfc:'' }}" name="rfc" rows="4" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success" style="float:right; margin-top:15px; margin-top: 25px;">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
