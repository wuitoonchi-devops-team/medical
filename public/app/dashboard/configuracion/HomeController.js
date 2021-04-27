route = "dashboard/configuracion";
//Edit BranchOffice
$("#frmEdit").validate({
    submitHandler: function (form) {
        itemData = new FormData(form);
        Core.post(route+'/update/1', itemData)
        .then(function (res){
            $('#mdlEdit').modal('hide');
            Core.showToast("success",res.data.message);
            getData();
        })
        .catch(function (err) {
            console.log(err);
            Core.showToast('error',err.response.data.message);
        });
}});

