let btnGuardar = document.getElementById('guardar');

btnGuardar.addEventListener('click',async ()=>{
    //Inputs-----------------------------------------------------------------
    let codigo = document.getElementById('codigo');
    let lugar = document.getElementById('lugar');
    let consultorio = document.getElementById('consultorio');
    let fecha = document.getElementById('fecha');
    let hora = document.getElementById('hora');
    let doctor = document.getElementById('doctor');
    let paciente = document.getElementById('paciente');
   //---------------------------------------------------------------------------
   //Validaciones --------------------------------------------------------------
   if(errores.isEmpty(codigo)){
    errores.setError(codigo);
   }
   if(errores.isEmpty(lugar)){
    errores.setError(lugar);
   }

   if(errores.isEmpty(fecha)){
    errores.setError(fecha);
   }
   if(errores.isEmpty(consultorio)){
    errores.setError(consultorio);
   }
   if(errores.isEmpty(hora)){
    errores.setError(hora);
   }
   if(errores.isEmpty(doctor)){
    errores.setError(doctor);
   }
   if(errores.isEmpty(paciente)){
    errores.setError(paciente);
   }

   //----------------------------------------------------------------------------


   if(errores.count_errors()>0){
    alerta.show('Debes llenar los campos o ingresar datos válidos','danger');
   }else{
    
    let formData = new FormData();
    formData.append('codigo',codigo.value);
    formData.append('lugar',lugar.value);
    formData.append('fecha',fecha.value);
    formData.append('consultorio',consultorio.value);
    formData.append('hora',hora.value);
    formData.append('doctor',doctor.value);
    formData.append('paciente',paciente.value);
 
    spinner.show(btnGuardar);
    let res = await peticion.post('cita','new',formData);
    spinner.hide(btnGuardar);
    switch (res.status) {
        case 400:
            res.body.forEach(({input}) => {
                errores.setById(input);
            });
            alerta.show('Debes ingresar datos válidos.','danger');
            break;
        case 201:
            alerta.show('Médico creado','success');
            window.location.href = 'index.php?controller=cita';
            break;
        default:
            alerta.show('Error al intentar crear, por favor intenta más tarde.');
            console.error(res);
            break;
    }
   }

});