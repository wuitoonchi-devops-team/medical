<input type="hidden" name="id" id="id">
<div class="row">
    <div class="col-sm-12">
        <select name="paciente_id" id="paciente_id" class="form-control">
            @foreach ($pacientes as $paciente)
            <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-form-label" for="textarea-input">Motivo de consulta</label>
                    <textarea id="textarea-input" id="motivo" name="motivo" rows="4" class="form-control" placeholder="Motivo de consulta"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="name">Peso(Kg)</label>
                    <input type="number" class="form-control" id="peso" name="peso" placeholder="0">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                <label for="name">Talla(mts)</label>
                <input type="number" class="form-control" id="talla" name="talla" placeholder="0">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="name">IMC</label>
                    <input type="number" class="form-control" id="imc" name="imc" placeholder="0">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="name">Temperatura</label>
                    <input type="number" class="form-control" id="temperatura" name="temperatura" placeholder="0">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="name">P. Sistole</label>
                    <input type="number" class="form-control" id="arterial_sistole" name="arterial_sistole" placeholder="0">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="name">P. Diastole</label>
                    <input type="number" class="form-control" id="arterial_diastole" name="arterial_diastole" placeholder="0">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="name">F. Cardiaca</label>
                    <input type="number" class="form-control" id="arterial_frecuencia" name="arterial_frecuencia" placeholder="0">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="name">F. Respiratoria</label>
                    <input type="number" class="form-control" id="frecuencia_respiratoria" name="frecuencia_respiratoria" placeholder="0">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                <label class="col-form-label" for="textarea-input">Análisis, Plan de estudios y tratamiento</label>
                <textarea id="textarea-input" id="tratamiento" name="tratamiento" rows="4" class="form-control" placeholder="Tratamiento"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="edad">Edad</label>
            <input type="number" class="form-control" id="edad" name="edad" value="{{ $paciente->edad }}">
        </div>
        <label for="">Referido a:</label>
        <div class="form-check">
            <input id="receta" class="form-check-input" type="checkbox" name="receta" value="1">
            <label for="receta" class="form-check-label">Receta</label>
        </div>
        <div class="form-check">
            <input id="laboratorios" class="form-check-input" type="checkbox" name="laboratorios" value="1">
            <label for="laboratorios" class="form-check-label"> Laboratorios</label>
        </div>
        <div class="form-check">
            <input id="rayosx" class="form-check-input" type="checkbox" name="rayosx" value="1">
            <label for="rayosx" class="form-check-label"> Rayos X</label>
        </div>
        <div class="form-check">
            <input id="indicaciones" class="form-check-input" type="checkbox" name="indicaciones" value="1">
            <label for="indicaciones" class="form-check-label"> Indicaciones</label>
        </div>
    </div>
</div>