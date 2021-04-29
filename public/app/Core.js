Core = {
    status: function(status) {
        switch (parseInt(status)) {
            case 0:
                return 'Inactivo';
                break;
            case 1:
                return 'Activo';
                break;
            case 2:
                return 'Bloqueado';
                break;

            default:
                break;
        }
    },
    post: function(url, data) {
        return axios.post(urlWeb + "/" + url, data);
    },
    get: function(url) {
        return axios.get(urlWeb + "/" + url);
    },
    buttons: function(index) {
        buttons = `<center>
                        <i class="fa fa-edit text-warning p-2" id="btnEdit" data-index='${index}' data-toggle="modal" data-target="#mdlEdit" style="cursor: pointer;"></i>
                        <i class="fa fa-trash text-danger" id="btnDelete" data-index='${index}' style="cursor: pointer;"></i>
                    </center>`;
        return buttons;
    },
    setDataTable: function(name) {
        tblData = $('#' + name).DataTable({
            lengthMenu: [
                [10, 50, 100, -1],
                [10, 50, 100, 'Todo']
            ],
            language: {
                url: './app/Spanish.json',
                pageLength: 5
            },
            "scrollX": true,
            "autoWidth": true,
            columnDefs: [{
                targets: [0],
                visible: false,
                searchable: false
            }]
        });
    },
    setDataTable2: function(name) {
        tblData2 = $('#' + name).DataTable({
            lengthMenu: [
                [10, 50, 100, -1],
                [10, 50, 100, 'Todo']
            ],
            language: {
                url: './app/Spanish.json',
                pageLength: 5
            },
            "scrollX": true,
            columnDefs: [{
                targets: [0],
                visible: false,
                searchable: false
            }]
        });
    },
    setDataTableCustome: function(id){
        var tableCUstome = $(`#${id}`).DataTable({
            lengthMenu: [
                [10, 50, 100, -1],
                [10, 50, 100, 'Todo']
            ],
            language: {
                url: './app/Spanish.json',
                pageLength: 5
            },
            "scrollX": true,

        });
        return tableCUstome;
    },
    clearForm: function(form) {
        $(form)[0].reset();
    },
    config:{
        getUrlWeb:  urlWeb,
        getUrlBase: urlBase
    },
    //CRUD ITEMS
    crud: {
        getAll: function() {
            return axios.get(urlWeb + route + '/all');
        },
        store: function() {
            return axios.post(urlWeb + route + '/store', itemData);
        },
        find: function(id) {
            return axios.get(urlWeb + route + '/find/' + id);
        },
        update: function(id) {
            return axios.post(urlWeb + route + '/update/' + id, itemData);
        },
        destroy: function(id) {
            console.log(urlWeb + route + '/destroy/' + id);
            return axios.get(urlWeb + route + '/destroy/' + id);
        }
    },
    showToast: function(type, message) {
        switch(type){
            case "error":{
                toastr.error(message);
                break;
            }
            case "success":{
                toastr.success(message);
                break;
            }
            case "info":{
                toastr.info(message);
                break;
            }
            case "warning":{
                toastr.warning(message);
                break;
            }
        }
    },
    showAlert: function(type, data) {
        switch(type){
            case "error":{
                Swal.fire({
                    icon:'error',
                    title:'Algo no ha ido bien...',
                    text:data
                });
                break;
            }
            case "success":{
                Swal.fire({
                    icon:'success',
                    title:'Procesado correctamente.',
                    text:data
                });
                break;
            }
            case "info":{
                Swal.fire({
                    icon:'info',
                    title:'Importante',
                    text:data
                });
                break;
            }
            case "warning":{
                Swal.fire({
                    icon:'warning',
                    title:'Advertencia',
                    text:data
                });
                break;
            }
        }
    },
    showAlertConsulta: function(data, id){
        Swal.fire({
            icon:'success',
            title:'Procesado correctamente.',
            text:data
        }).then((res) => {
            if(res.value){
                window.open('/dashboard/consultas/imprimir-consulta/'+id);
            }
        });
    },
    setThousands: function(x) {
      x =parseFloat(x).toFixed(2)+"";
      var parts = x.toString().split(".");
      parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      return parts.join(".");
    },
    showProccessingMessage: function (message){
        $.blockUI({
            message: message,
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            },
            baseZ: 4000});
    },
    hideProccessingMessage: function (){
         $.unblockUI();
    },
    getSearchParams: function(k){
        var p={};
        location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){p[k]=v})
        return k?p[k]:p;
    },
    recargarConCache: function(){
        location.reload()
    },
    recargarSinCache(){
        location.reload(true)
    },
    setColorPicker: function(id){
        $(id).colorpickle({
            showOk: true,
            clickToggle:true,
            visible:false,
            hslSliders:false,
            closeOnOk:true,
            closeOnCancel:true,
            mode:'hex',
            showSwatch:true,
            textCancel:'Cancelar',
            textOk:'Aceptar',
            theme:'colorpickle-theme-light',
            showCancel: true
        });
    },
    getUser: {
        Id: function(){
            return sessionStorage.getItem('user');
        },
        Level: function(){
            return sessionStorage.getItem('level');
        }
    },
    orderStatusText(status){
        switch(status){
            case 0:{  status = 'Nuevo'; break;}
            case 1:{  status = 'Aceptado'; break;}
            case 2:{  status = 'Asignado'; break;}
            case 3:{  status = 'Atendiendo'; break;}
            case 4:{  status = 'Atendido'; break;}
            case 5:{  status = 'Rechazado'; break;}
        }
        return status;
    },
    getDistance : function(data,unit='K')
        {
            console.log(data);
            lat1 = data.start.lat;
            lon1 = data.start.lng;
            lat2 = data.end.lat;
            lon2 = data.end.lng;
            if ((lat1 == lat2) && (lon1 == lon2)) {
                return 0;
            }
            else {
                var radlat1 = Math.PI * lat1/180;
                var radlat2 = Math.PI * lat2/180;
                var theta = lon1-lon2;
                var radtheta = Math.PI * theta/180;
                var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
                if (dist > 1) {
                    dist = 1;
                }
                dist = Math.acos(dist);
                dist = dist * 180/Math.PI;
                dist = dist * 60 * 1.1515;
                if (unit=='K') { dist = dist * 1.609344;}
                if (unit=="N") { dist = dist * 0.8684 }
                return dist;
            }
    },
    print: function(item){
        var divToPrint=document.getElementById(item);
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write(`
            <html>
                <head>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                </head>
                <body onload="window.print()">
                ${divToPrint.innerHTML}
                </body>
            </html>`);
        newWin.document.close();
        setTimeout(function(){newWin.close();},10);
    },
    setCustomeInputPhone(name,id) {
        window[name] = document.querySelector(id);
        window[name] = window.intlTelInput(window[name], {
            initialCountry:'mx',
            onlyCountries:[
            "us",
            "mx"
            ],
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.1/js/utils.js"
        });
    },
    setRichTextArea($idElementTextArea) {
        return tinymce.init({
            selector: $idElementTextArea,
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent code| ' +
                'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        });
    },
    getEdadDesdeFecha(dateInput) {
        var dateParsed = moment(dateInput.dob).format('YYYY-DD-MM')
        return moment().diff(dateInput,'years');
    },
    getFechaDesdeEdad(edad) {
        return moment().subtract(edad*365, "days").format('yyyy-MM-DD')
      }
};
//Eventos Generales
$(document).on('click', '#btnEdit', function() {
    itemData = arrData[$(this).data('index')];
    showItem();
});
$(document).on('click', '#btnDelete', function() {
    item = arrData[$(this).data('index')];
    bootbox.confirm({
        message: 'Confirmar eliminación',
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
                Core.crud.destroy(item.id).then(function(res) {
                    Core.showToast('success',res.data.message);
                    getData();
                }).catch(function(err) {
                    console.log(err);
                    //Core.showAlert('error', err.response.data.error.message);
                })
            }
        }
    });
});
$( window ).on('load',function() {
    //Collapse and Expand Sidebar default on reload page
    if(localStorage.getItem('toggleSidebar')!=null) {
        if(localStorage.getItem('toggleSidebar')==1) {
            $('#sidebar').addClass('c-sidebar-minimized');
            $('#sidebar>ul.c-sidebar-nav').removeClass('ps');
        }
    }
    $('.c-sidebar-minimizer').click(function(){
        if(localStorage.getItem('toggleSidebar')!=null) {
            if(localStorage.getItem('toggleSidebar')==1) {
                localStorage.setItem('toggleSidebar',0);
            } else {
                localStorage.setItem('toggleSidebar',1);
            }
        }else {
            localStorage.setItem('toggleSidebar',1);
        }
    });
});
loadProgressBar();
axios.interceptors.request.use(function (config) {
    $.blockUI({ css: {
        border: 'none',
        padding: '15px',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: .5,
        color: '#fff'
    },
    baseZ: 2000,
    message: 'Procesando...'
     });
    return config;
  }, function (error) {$.unblockUI();return Promise.reject(error);});
axios.interceptors.response.use(function (response) { $.unblockUI(); return response;}, function(err) { $.unblockUI(); return Promise.reject(err);});
