let btnGuardar = document.getElementById('guardar');

btnGuardar.addEventListener('click',async ()=>{
    //Inputs-----------------------------------------------------------------
    let documento = document.getElementById('documento');
    let email = document.getElementById('email');
   //---------------------------------------------------------------------------
   //Validaciones --------------------------------------------------------------
   if(errores.isEmpty(documento)){
    errores.setError(documento);
   }
   if(errores.isEmpty(email)){
    errores.setError(email);
   }
 

   //----------------------------------------------------------------------------

   if(errores.count_errors()>0){
    alerta.show('Debes llenar los campos o ingresar datos válidos','danger');
   }else{
    let formData = new FormData();
    formData.append('documento',documento.value);
    formData.append('email',email.value);

    spinner.show(btnGuardar);
    let res = await peticion.post('admins','storage',formData);
    spinner.hide(btnGuardar);
    switch (res.status) {
        case 400:
            res.body.forEach(({input}) => {
                errores.setById(input);
            });
            alerta.show('Debes ingresar datos válidos.','danger');
            break;
        case 201:
            window.location.href = 'index.php?controller=admins';
            break;
        default:
            alerta.show('Error al intentar crear, por favor intenta más tarde.');
            console.error(res);
            break;
    }
   }

});