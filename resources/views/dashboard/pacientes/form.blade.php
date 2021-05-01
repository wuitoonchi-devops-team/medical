<input type="hidden" name="id" id="id">
<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control" id="nombre"  name="nombre" placeholder="Nombre" required>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
        <label for="name">Sexo</label>
        <select class="form-control" id="sexo" name="sexo" required>
            <option value="M">M</option>
            <option value="F">F</option>
        </select>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
        <label for="name">Edad</label>
        <input type="number" class="form-control" id="edad" name="edad" placeholder="Edad">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
        <label class="col-form-label" for="textarea-input">Alergias</label>
        <textarea id="textarea-input" id="alergias" name="alergias" rows="4" class="form-control" placeholder="Alergias"></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
        <label class="col-form-label" for="textarea-input">Enfermedades Crónicas</label>
        <textarea id="textarea-input" id="enfermedades_cronica" name="enfermedades_cronica" rows="4" class="form-control" placeholder="Enfermedades crónica"></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label class="col-form-label" for="textarea-input">Estatus</label>
            <select class="form-control" id="estatus" name="estatus" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
    </div>
</div>