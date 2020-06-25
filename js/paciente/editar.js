let btnGuardar = document.getElementById('guardar');

btnGuardar.addEventListener('click',async ()=>{

    let codigo = location.search.split('=')[location.search.split('=').length-1];
    //Inputs-----------------------------------------------------------------
    let documento = document.getElementById('documento');
    let nombre = document.getElementById('nombre');
    let direccion = document.getElementById('direccion');
    let telefono = document.getElementById('telefono');
    let fecha_naciemiento = document.getElementById('fecha_naciemiento');
    let estado = document.getElementById('estado');
    let genero = document.getElementById('genero');
    let eps = document.getElementById('eps');
    let email = document.getElementById('email');
   //---------------------------------------------------------------------------
   //Validaciones --------------------------------------------------------------
   if(errores.isEmpty(documento)){
    errores.setError(documento);
   }
   if(errores.isEmpty(nombre)){
    errores.setError(nombre);
   }
   if(errores.isEmpty(direccion)){
    errores.setError(direccion);
   }
   if(errores.isEmpty(fecha_naciemiento)){
    errores.setError(fecha_naciemiento);
   }
   if(errores.isEmpty(telefono)){
    errores.setError(telefono);
   }
   if(errores.isEmpty(estado)){
    errores.setError(estado);
   }
   if(errores.isEmpty(genero)){
    errores.setError(genero);
   }
   if(errores.isEmpty(eps)){
    errores.setError(eps);
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
    formData.append('nombre',nombre.value);
    formData.append('direccion',direccion.value);
    formData.append('fecha_naciemiento',fecha_naciemiento.value);
    formData.append('telefono',telefono.value);
    formData.append('estado',estado.value);
    formData.append('genero',genero.value);
    formData.append('eps',eps.value);
    formData.append('email',email.value);
    formData.append('documento_old',codigo);
    spinner.show(btnGuardar);
    let res = await peticion.post('paciente','update',formData);
    spinner.hide(btnGuardar);   
    switch (res.status) {
        case 400:
            res.body.forEach(({input}) => {
                errores.setById(input);
            });
            alerta.show('Debes ingresar datos válidos.','danger');
            break;
        case 200:
            window.location.href = 'index.php?controller=paciente';
            break;
        default:
            alerta.show('Error al intentar crear, por favor intenta más tarde.');
            console.error(res);
            break;
    }
   }

});