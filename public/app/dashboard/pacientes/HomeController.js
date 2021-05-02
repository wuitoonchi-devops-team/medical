route = "/dashboard/pacientes";
arrData = [];
arrEstados = [];
tblData = $('#dataTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: route+"/datatable",
    language: {
        url: urlBase+'app/Spanish.json',
        pageLength: 5
    },
    columns: [
        {data: 'nombre', name: 'nombre', orderable: true, searchable: true},
        {data: 'alergias', name: 'alergias'},
        {data: 'enfermedades_cronica', name: 'enfermedades_cronica'},
        {data: 'edad', name: 'edad', orderable: true, searchable: true},
        {data: 'sexo', name: 'sexo', orderable: true, searchable: true},
        {data: 'estatus', name: 'estatus'},
        {data: 'estatus', name: 'estatus'},
    ],
    columnDefs: [ 
        { 
            targets: 1, render: function ( data, type, row, meta ) {
                return row.alergias;
        }},
        { 
            targets: 2, render: function ( data, type, row, meta ) {
            return row.enfermedades_cronica;
        }},
        { 
            targets: 5, render: function ( data, type, row, meta ) {
            return `<center>${row.estatus==1?'<span class="text-success">Activo</span>':'<span class="text-danger">Inactivo</span>'}</center>`
        }},
        { 
            targets: 6, render: function ( data, type, row, meta ) {
            return `<center>
                        <a class="fa fa-book text-dark p-2" id="btnView" href="${route+'/consultas/home/'+row.id}" style="cursor: pointer;" title="Ver consultas de ${row.nombre}"></a>
                        <i class="fa fa-edit text-warning p-2" id="btnEdit" data-index='${meta.row}' data-toggle="modal" data-target="#mdlEdit" style="cursor: pointer;" title="Editar paciente"></i>
                        <i class="fa fa-trash text-danger" id="btnDelete" data-index='${meta.row}' style="cursor: pointer;" title="Eliminar paciente"></i>
                    </center>`;
        }},
    ]
});
//get Firt data to arrData Array
tblData.ajax.reload( function ( json ) {
    arrData = json.data;
});

window.getData = function() {
    //each reload datatable set data to arrData Array
    tblData.ajax.reload(function( json ){
        arrData = json.data;
    });
}
function getEstados() {
    Core.get('dashboard/estados').then( function(res) {
        arrEstados = res.data;
        arrEstados.forEach(function(item,index){
                $('#frmNew select[name=estado_id]').append($('<option></option>').val(item.id).html(item.nombre));
                $('#frmEdit select[name=estado_id]').append($('<option></option>').val(item.id).html(item.nombre));
            });
    }).catch( function(err) {
        Core.showAlert('error','No ha sido posible cargar estados.');
    });
}

window.showItem = function() {
    console.log(itemData);
    $('#frmEdit input[name=id]').val(itemData.id);
    $('#frmEdit input[name=nombre]').val(itemData.nombre);
    $('#frmEdit input[name=sexo]').val(itemData.sexo);
    $('#frmEdit input[name=edad]').val(itemData.edad);
    $('#frmEdit textarea[name=alergias]').val(itemData.alergias);
    $('#frmEdit textarea[name=enfermedades_cronica]').val(itemData.enfermedades_cronica);
    $('#frmEdit select[name=estatus]').val(itemData.estatus);
}

$('#frmNew').validate({
  submitHandler: function (form) {
  itemData = new FormData(form);
  Core.crud.store().then(function(res) {
    Core.showToast('success','Registro exitoso');
    getData();
    $('#mdlNew').modal('hide');
  })
  .catch(function (err) {
      console.log(err.response);
      if(err.response) {
          console.log(err.response.data.error);
        Core.showAlert('error',err.response.data.error.message);
      } else {
        Core.showAlert('error','No ha sido posible registrar paciente, verifique su informacón he intente nuevamente.');
      }
  })
}});

$('#frmEdit').validate({
    submitHandler: function (form) {
    itemData = new FormData(form);
    //Axios Http Post Request
    Core.crud.update($('#frmEdit input[id=id]').val()).then(function(res) {
        Core.showToast('success','Registro editado exitosamente');
        $('#mdlEdit').modal('hide');
    }).catch(function(err) {
        Core.showAlert('error','No ha sido posible editar paciente, intente nuevamente');
    }).finally(function(){
        getData();
    })
}});
$(document).ready(function() {
    getEstados();
    $('#dataTable').tooltip();
})