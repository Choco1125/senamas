let btnGuardar = document.getElementById('guardar');

btnGuardar.addEventListener('click',async ()=>{

    //Inputs-----------------------------------------------------------------
    let password = document.getElementById('password');
   //---------------------------------------------------------------------------
   //Validaciones --------------------------------------------------------------
   if(errores.isEmpty(password)){
    errores.setError(password);
   }
   

   //----------------------------------------------------------------------------

   if(errores.count_errors()>0){
    alerta.show('Debes llenar los campos o ingresar datos válidos','danger');
   }else{
    let formData = new FormData();
    formData.append('password',password.value);

    spinner.show(btnGuardar);
    let res = await peticion.post('password','update',formData);
    spinner.hide(btnGuardar);
    switch (res.status) {
        case 400:
            res.body.forEach(({input}) => {
                errores.setById(input);
            });
            alerta.show('Debes ingresar datos válidos.','danger');
            break;
        case 200:
            alerta.show('Contraseña actualizada','success');
            window.location.href = 'index.php';
            break;
        default:
            alerta.show('Error al intentar crear, por favor intenta más tarde.');
            console.error(res);
            break;
    }
   }

});