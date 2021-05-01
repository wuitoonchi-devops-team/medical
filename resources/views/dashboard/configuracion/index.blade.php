@extends('dashboard.layout.main')
@section('content')
    <div class="card">
        <form enctype="multipart/form-data" method="post" id="frmEdit">
            <div class="card-header"><strong>Configuración</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5" style="text-align: center;">
                        <img src="{{ isset($configuracion) && $configuracion->logo !== NULL ? asset($configuracion->logo) : asset('assets/data/logo-default.png') }}" id="previewDefault" class="profilePreview">
                        <hr>
                        <input type="file" name="logo" id="logo">
                        <hr>
                    </div>
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="textarea-input">Institución</label>
                                    <input id="institucion" value="{{ isset($configuracion) && $configuracion->institucion !== NULL ? $configuracion->institucion : "" }}" name="institucion" rows="4" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="textarea-input">Dirección</label>
                                    <input id="direccion" value="{{ isset($configuracion) && $configuracion->direccion !== NULL ? $configuracion->direccion : "" }}" name="direccion" rows="4" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="textarea-input">Télefonos de consultorio</label>
                                    <input id="tels" value="{{ isset($configuracion) && $configuracion->tels !== NULL ? $configuracion->tels : "" }}" name="tels" rows="4" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="textarea-input">Horario</label>
                                    <input id="horario" value="{{ isset($configuracion) && $configuracion->horario !== NULL ? $configuracion->horario : "" }}" name="horario" rows="4" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="textarea-input">RFC</label>
                                    <input id="rfc" value="{{ isset($configuracion) && $configuracion->rfc !== NULL ? $configuracion->rfc : "" }}" name="rfc" rows="4" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="textarea-input">Nombre de médico</label>
                                    <input id="medico" value="{{ isset($configuracion) && $configuracion->medico !== NULL ? $configuracion->medico : "" }}" name="medico" rows="4" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="textarea-input">Especialización</label>
                                    <input id="especializacion" value="{{ isset($configuracion) && $configuracion->especializacion !== NULL ? $configuracion->especializacion : "" }}" name="especializacion" rows="4" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="textarea-input">D.G.P</label>
                                            <input id="dgp" value="{{ isset($configuracion) && $configuracion->dgp !== NULL ? $configuracion->dgp : "" }}" name="dgp" rows="4" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="textarea-input">Reg. S.S</label>
                                            <input id="regss" value="{{ isset($configuracion) && $configuracion->regss !== NULL ? $configuracion->regss : "" }}" name="regss" rows="4" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="textarea-input"><b>Contraseña(solo si se cambiará)</b></label>
                                    <input id="password" name="password" rows="4" class="form-control">
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
        </form>
    </div>
@endsection
