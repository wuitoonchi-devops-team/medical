<input type="hidden" name="id" id="id">
<input type="hidden" name="paciente_id" id="paciente_id" value="{{ $data->id }}">
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
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="name">C. Abdominal(cm)</label>
                    <input type="number" class="form-control" id="circunferencia_abdominal" name="circunferencia_abdominal" placeholder="0">
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="name">Pronostico ligado a evolución</label>
                    <select class="form-control" id="pronostico_ligado_evolucion" name="pronostico_ligado_evolucion">
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>
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
        <label for="">Referido a:</label>
        <div class="form-check">
            <input id="receta" class="form-check-input" type="checkbox" name="receta" value="1">
            <label for="receta" class="form-check-label">Receta</label>
        </div>
        <div class="form-check">
            <input id="controlados" class="form-check-input" type="checkbox" name="controlados" value="1">
            <label for="controlados" class="form-check-label"> Controlados</label>
        </div>
        <div class="form-check">
            <input id="laboratorios" class="form-check-input" type="checkbox" name="laboratorios" value="1">
            <label for="laboratorios" class="form-check-label"> Laboratorios</label>
        </div>
        <div class="form-check">
            <input id="rayosx" class="form-check-input" type="checkbox" name="rayosx" value="1">
            <label for="rayosx" class="form-check-label"> Gabinete Rayos X</label>
        </div>
        <div class="form-check">
            <input id="interconsulta" class="form-check-input" type="checkbox" name="interconsulta" value="1">
            <label for="interconsulta" class="form-check-label"> Referencia / Interconsulta</label>
        </div>
        <div class="form-check">
            <input id="indicaciones" class="form-check-input" type="checkbox" name="indicaciones" value="1">
            <label for="indicaciones" class="form-check-label"> Indicaciones</label>
        </div>
        <div class="form-check">
            <input id="electrocardiograma" class="form-check-input" type="checkbox" name="electrocardiograma" value="1">
            <label for="electrocardiograma" class="form-check-label"> Electrocardiograma</label>
        </div>
        <div class="form-check">
            <input id="incapacidad" class="form-check-input" type="checkbox" name="incapacidad" value="1">
            <label for="incapacidad" class="form-check-label"> Incapacidad</label>
        </div>
        <div class="form-check">
            <input id="constancia_asistencia" class="form-check-input" type="checkbox" name="constancia_asistencia" value="1">
            <label for="constancia_asistencia" class="form-check-label"> Constancia Asistencia</label>
        </div>
        <div class="form-check">
            <input id="cuidados_maternos" class="form-check-input" type="checkbox" name="cuidados_maternos" value="1">
            <label for="cuidados_maternos" class="form-check-label"> Ciudados Maternos</label>
        </div>
        <div class="form-check">
            <input id="citologia_cerv_vaginal" class="form-check-input" type="checkbox" name="citologia_cerv_vaginal" value="1">
            <label for="citologia_cerv_vaginal" class="form-check-label"> Citología Cerv. Vaginal</label>
        </div>
        <div class="form-check">
            <input id="preparados" class="form-check-input" type="checkbox" name="preparados" value="1">
            <label for="preparados" class="form-check-label"> Preparados</label>
        </div>
        <div class="form-check">
            <input id="estudios_especiales" class="form-check-input" type="checkbox" name="estudios_especiales" value="1">
            <label for="estudios_especiales" class="form-check-label"> Estudios especiales</label>
        </div>
        <div class="form-check">
            <input id="estudios_audiologicos" class="form-check-input" type="checkbox" name="estudios_audiologicos" value="1">
            <label for="estudios_audiologicos" class="form-check-label"> Estudios Audiologícos</label>
        </div>
        <div class="form-check">
            <input id="sugerir_cirugia" class="form-check-input" type="checkbox" name="sugerir_cirugia" value="1">
            <label for="sugerir_cirugia" class="form-check-label"> Sugerir cirugia</label>
        </div>
        <div class="form-check">
            <input id="proc_urologia" class="form-check-input" type="checkbox" name="proc_urologia" value="1">
            <label for="proc_urologia" class="form-check-label"> Proc. Urología</label>
        </div>
        <div class="form-check">
            <input id="proc_hematologia" class="form-check-input" type="checkbox" name="proc_hematologia" value="1">
            <label for="proc_hematologia" class="form-check-label"> Proc. Hematología</label>
        </div>
        <div class="form-check">
            <input id="valoracion_preanestecia" class="form-check-input" type="checkbox" name="valoracion_preanestecia" value="1">
            <label for="valoracion_preanestecia" class="form-check-label"> Valoracion Preanestecia</label>
        </div>
        <div class="form-check">
            <input id="contrareferencia" class="form-check-input" type="checkbox" name="contrareferencia" value="1">
            <label for="contrareferencia" class="form-check-label"> Contrareferencia</label>
        </div>
    </div>
</div>