let btnGuardar = document.getElementById('guardar');

btnGuardar.addEventListener('click',async ()=>{
    //Inputs-----------------------------------------------------------------
    let codigo = document.getElementById('codigo');
    let nombre = document.getElementById('nombre');
    let descripcion = document.getElementById('descripcion');
   //---------------------------------------------------------------------------
   //Validaciones --------------------------------------------------------------
   if(errores.isEmpty(codigo)){
    errores.setError(codigo);
   }
   if(errores.isEmpty(nombre)){
    errores.setError(nombre);
   }
   if(errores.isEmpty(descripcion)){
    errores.setError(descripcion);
   }

   //----------------------------------------------------------------------------

   if(errores.count_errors()>0){
    alerta.show('Debes llenar los campos o ingresar datos válidos','danger');
   }else{
    let formData = new FormData();
    formData.append('codigo',codigo.value);
    formData.append('nombre',nombre.value);
    formData.append('descripcion',descripcion.value);

    spinner.show(btnGuardar);
    let res = await peticion.post('especialidad','new',formData);
    spinner.hide(btnGuardar);
    switch (res.status) {
        case 400:
            res.body.forEach(({input}) => {
                errores.setById(input);
            });
            alerta.show('Debes ingresar datos válidos.','danger');
            break;
        case 201:
            alerta.show('Especialidad creada','success');
            window.location.href = 'index.php?controller=especialidad';
            break;
        default:
            alerta.show('Error al intentar crear, por favor intenta más tarde.');
            console.error(res);
            break;
    }
   }

});