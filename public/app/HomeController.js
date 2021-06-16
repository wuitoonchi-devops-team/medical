$("#frmLogin").validate({
    submitHandler: function (form) {
        itemData = new FormData(form);
        Core.post('login', itemData)
        .then(function (res) {
            if(res.data.err==false) {
                Core.showToast('success','Acceso correcto, redirigiendo...');
                setTimeout(function() {
                    window.location = urlWeb +"/dashboard/home";
                },1500);
            }else{
                Core.showToast('error','Datos de acceso incorrectos, intente nuevamente.');
            }
        })
        .catch(function (err) {
            console.log(err);
            Core.showToast('error','No ha sido posible autenticar, por favor intente nuevamente.');
        });
    }
});
init();
function init() {
}

