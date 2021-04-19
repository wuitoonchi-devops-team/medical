route = "/dashboard/consultas";
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
        {data: 'created_at', name: 'created_at', orderable: true, searchable: true},
        {data: 'motivo', name: 'motivo', orderable: true, searchable: true},
        {data: 'ligado', name: 'ligado'},
        {data: 'ligado', name: 'ligado'},
    ],
    columnDefs: [ 
        { 
            targets: 0, render: function ( data, type, row, meta ) {
                return moment(row.created_at).format('D-M-Y h:m A')
            }
        },
        { 
            targets: 1, render: function ( data, type, row, meta ) {
                return row.motivo
            }
        },
        { 
            targets: 2, render: function ( data, type, row, meta ) {
                return `<center>${row.pronostico_ligado_evolucion==1?'Sí':'No'}</center>`
            }
        },
        { 
            targets: 3, render: function ( data, type, row, meta ) {
            return `<center>
                        <i class="fa fa-edit text-warning p-2" id="btnEdit" data-index='${meta.row}' data-toggle="modal" data-target="#mdlEdit" style="cursor: pointer;"></i>
                        <i class="fa fa-trash text-danger" id="btnDelete" data-index='${meta.row}' style="cursor: pointer;"></i>
                    </center>`;
        }},
    ]
});
//get Firt data to arrData Array
tblData.ajax.reload( function ( json ) {
    arrData = json.data;
});

//Autocomplete product function
var options = {
    url: function(phrase) {
      return route+"/buscar_paciente";
    },
    getValue: function(item) {
      return item.nombre
    },
    ajaxSettings: {
      dataType: "json",
      method: "POST",
      data: {
        dataType: "json"
      }
    },
    preparePostData: function(data) {
        return { _token:$('input[name=csrf-token]').val(),
                  search: $('#frmNew input[name=paciente]').val()
              };
    },
    list: {
       onSelectItemEvent: function() {
          $('#frmNew input[id=paciente_id]').val($("#frmNew input[name=paciente_id]").getSelectedItemData().id);
          newItemComplements = $("#frmNew input[name=paciente]").getSelectedItemData()
      }
    },
    requestDelay: 200
};
$("#frmNew input[name=paciente]").easyAutocomplete(options);
window.getData = function() {
    //each reload datatable set data to arrData Array
    tblData.ajax.reload(function( json ){
        arrData = json.data;
    });
}

window.showItem = function() {
    $('#frmEdit input[name=id]').val(itemData.id);
    $('#frmEdit select[name=paciente_id]').val(itemData.paciente_id).trigger('change');
    $('#frmEdit textarea[name=motivo]').val(itemData.motivo);
    $('#frmEdit input[name=peso]').val(itemData.peso);
    $('#frmEdit input[name=talla]').val(itemData.talla);
    $('#frmEdit input[name=imc]').val(itemData.imc);
    $('#frmEdit input[name=temperatura]').val(itemData.temperatura);
    $('#frmEdit input[name=arterial_sistole]').val(itemData.arterial_sistole);
    $('#frmEdit input[name=arterial_diastole]').val(itemData.arterial_diastole);
    $('#frmEdit input[name=arterial_frecuencia]').val(itemData.arterial_frecuencia);
    $('#frmEdit input[name=frecuencia_respiratoria]').val(itemData.frecuencia_respiratoria);
    $('#frmEdit input[name=circunferencia_abdominal]').val(itemData.circunferencia_abdominal);
    $('#frmEdit textarea[name=tratamiento]').val(itemData.tratamiento);
    $('#frmEdit input[name=pronostico_ligado_evolucion]').prop('checked',itemData.pronostico_ligado_evolucion=='1');
    $('#frmEdit input[name=receta]').prop('checked',itemData.receta=='1');
    $('#frmEdit input[name=rayosx]').prop('checked',itemData.rayosx=='1');
    $('#frmEdit input[name=interconsulta]').prop('checked',itemData.interconsulta=='1');
    $('#frmEdit input[name=indicaciones]').prop('checked',itemData.indicaciones=='1');
    $('#frmEdit input[name=electrocardiograma]').prop('checked',itemData.electrocardiograma=='1');
    $('#frmEdit input[name=incapacidad]').prop('checked',itemData.incapacidad=='1');
    $('#frmEdit input[name=constancia_asistencia]').prop('checked',itemData.constancia_asistencia=='1');
    $('#frmEdit input[name=cuidados_maternos]').prop('checked',itemData.cuidados_maternos=='1');
    $('#frmEdit input[name=citologia_cerv_vaginal]').prop('checked',itemData.citologia_cerv_vaginal=='1');
    $('#frmEdit input[name=preparados]').prop('checked',itemData.preparados=='1');
    $('#frmEdit input[name=estudios_especiales]').prop('checked',itemData.estudios_especiales=='1');
    $('#frmEdit input[name=estudios_audiologicos]').prop('checked',itemData.estudios_audiologicos=='1');
    $('#frmEdit input[name=sugerir_cirugia]').prop('checked',itemData.sugerir_cirugia=='1');
    $('#frmEdit input[name=proc_urologia]').prop('checked',itemData.proc_urologia=='1');
    $('#frmEdit input[name=proc_hematologia]').prop('checked',itemData.proc_hematologia=='1');
    $('#frmEdit input[name=valoracion_preanestecia]').prop('checked',itemData.valoracion_preanestecia=='1');
    $('#frmEdit input[name=contrareferencia]').prop('checked',itemData.contrareferencia=='1');
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
//Calcular edad con fecha
$('#frmNew input[name=nacimiento]').on('change',function() {
    $('#frmNew input[name=edad]').val(Core.getEdadDesdeFecha($(this).val()));
});
//Calcular fecha con edad
$('#frmNew input[name=edad]').on('change',function() {
    $('#frmNew input[name=nacimiento]').val(Core.getEdadDesdeFecha($(this).val()));
});
$(document).ready(function() {
    $('#frmNew select[id=paciente_id]').select2({
        placeholder: 'Buscar paciente',
        dropdownParent: $('#mdlNew .modal-content')
    });
    $('#frmEdit select[name=paciente_id]').attr('id','paciente_id2');
    $('#frmEdit select[id=paciente_id2]').select2({
        placeholder: 'Buscar paciente',
        dropdownParent: $('#mdlEdit .modal-content')
    });
})