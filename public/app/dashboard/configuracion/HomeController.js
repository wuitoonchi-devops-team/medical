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

$(document).ready(function(){
    
    $("#logo").change(function(){
	    var imagen = this.files[0];
    
        if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
         
            $("#logo").val("");
            Core.showToast('error', 'La imagen debe estar en formato JPG o PNG');
        
        }else if(imagen["size"] > 2000000){
    
            $("#logo").val("");
            Core.showToast('error', 'La imagen no debe pesar más de 2MB');
                
        }else{
    
            var datosImagen = new FileReader;
            datosImagen.readAsDataURL(imagen);
    
            $(datosImagen).on("load", function(event){
                var rutaImagen = event.target.result;
                $(".profilePreview").attr("src", rutaImagen);
            });
        }
    });
});

