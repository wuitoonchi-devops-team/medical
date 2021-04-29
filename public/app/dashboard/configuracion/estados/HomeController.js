route = "/dashboard/configuracion/estados";
    arrStates = [];
    var tblData = $('#arrData').DataTable({
            lengthMenu: [
                [10, 50, 100, -1],
                [10, 50, 100, 'Todos']
            ],
            language: {
                url: urlBase+'app/Spanish.json',
                pageLength: 5
            },
            "scrollX": true,
            columnDefs: [{
                targets: [0],
                visible: false,
                searchable: false
            }]
    });
    //Crate new Category
    $("#frmNew").validate({
        submitHandler: function (form) {
          itemData = new FormData(form);
          Core.crud.store(itemData)
          .then(function (res) {
                $('#mdlNew').modal('hide');
                $('#frmNew').trigger('reset');
                Core.showToast("success",res.data.message);
          })
          .catch(function (err) {
              Core.showAlert('error',err.response.data.error.message);
          }).finally(function(){
            getData();
          });
    }});
    //Edit Category
    $("#frmEdit").validate({
            submitHandler: function (form) {
              itemData = new FormData(form);
              Core.crud.update($('#id').val())
              .then(function (res){
                    $('#mdlEdit').modal('hide');
                    Core.showToast("success",res.data.message);
                    $("#frmEdit").trigger('reset');
              })
              .catch(function (err) {
                  console.log(err.response);
                  Core.showAlert('error',err.response.data.error.message);
              }).finally(function(){
                getData();
              });
        }});
    window.getData = function() {
        tblData.rows().remove().draw();
        Core.crud.getAll().then(function(res) {
            arrData = res.data;
            res.data.forEach(function (item, index) {
                tblData.row.add([
                    index,
                    item.id,
                    item.nombre,
                    `<center>
                        <a href="${urlBase}dashboard/configuracion/estados/ciudades/home/${item.id}">
                            <i class="fa fa-map-marked"></i>
                        </a>
                    </center>`,
                    item.estatus==1?`<div style="color:green;">Activo</div>`:`<div style="color:orange;">Inactivo</div>`,
                    Core.buttons(index)
                ]).draw();
            });
        }).catch(function(err){
            Core.showToast('error','No ha sido posible cargar estados');
        });
    }
    window.showItem = function() {
        $('#id').val(itemData.id);
        $('#frmEdit input[name=nombre]').val(itemData.nombre);
        $('#frmEdit select[name=estatus]').val(itemData.estatus);
     }
    
    $('#all_disable').click(function() {
        bootbox.confirm({
            message: "Deshabilitar todos los estados.",
            buttons: {
                confirm: {
                    label: 'Sí',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result==true) {
                    axios.get(route+'/disable_all').then(function(){
                        Core.showToast('success','Procesao ralizado correctamente');
                        getData();
                    }).catch(function(){
                        Core.showToast('error','No ha sido posible procesar solicitud.');
                    });
                }
            }
        });
    });
    
    $('#all_enable').click(function() {
        bootbox.confirm({
            message: "Habilitar todos los estados.",
            buttons: {
                confirm: {
                    label: 'Sí',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result==true) {
                        axios.get(route+'/enable_all').then(function(){
                            getData();
                            Core.showToast('success','Procesao ralizado correctamente');
                        }).catch(function(){
                            Core.showToast('error','No ha sido posible procesar solicitud.');
                        });
                    }
                }
            });
    });

    function init(){
        getData();
    }
    init();
