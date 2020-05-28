let btnGuardar = document.getElementById('guardar');

btnGuardar.addEventListener('click', async () => {
    let codigo = location.search.split('=')[location.search.split('=').length-1];

    //Inputs-----------------------------------------------------------------
    let documento = document.getElementById('documento');
    let nombre = document.getElementById('nombre');
    let fecha_ingreso = document.getElementById('fecha_ingreso');
    let fecha_naciemiento = document.getElementById('fecha_naciemiento');
    let anos_experiencia = document.getElementById('anos_experiencia');
    let genero = document.getElementById('genero');
    let perfil_profesional = document.getElementById('perfil_profesional');
    let email = document.getElementById('email');
    let checkboxEspecialidades = document.getElementsByClassName('custom-control-input');
    //---------------------------------------------------------------------------
    //Validaciones --------------------------------------------------------------
    if (errores.isEmpty(documento)) {
        errores.setError(documento);
    }
    if (errores.isEmpty(nombre)) {
        errores.setError(nombre);
    }

    if (errores.isEmpty(fecha_naciemiento)) {
        errores.setError(fecha_naciemiento);
    }
    if (errores.isEmpty(fecha_ingreso)) {
        errores.setError(fecha_ingreso);
    }
    if (errores.isEmpty(anos_experiencia)) {
        errores.setError(anos_experiencia);
    }
    if (errores.isEmpty(genero)) {
        errores.setError(genero);
    }
    if (errores.isEmpty(perfil_profesional)) {
        errores.setError(perfil_profesional);
    }
    if (errores.isEmpty(email)) {
        errores.setError(email);
    }
    //----------------------------------------------------------------------------
   //Agregar especialidades------------------------------------------------------
   let especialidades = [];
   for(let i = 0; i< checkboxEspecialidades.length; i++){
        let especialidad = checkboxEspecialidades.item(i);
        if(especialidad.checked){
            especialidades.push(especialidad.id)
        }
    }
   //----------------------------------------------------------------------------
    if (errores.count_errors() > 0) {
        alerta.show('Debes llenar los campos o ingresar datos válidos', 'danger');
    } else {
        let formData = new FormData();
        formData.append('documento', documento.value);
        formData.append('nombre', nombre.value);
        formData.append('fecha_naciemiento', fecha_naciemiento.value);
        formData.append('fecha_ingreso', fecha_ingreso.value);
        formData.append('anos_experiencia', anos_experiencia.value);
        formData.append('genero', genero.value);
        formData.append('perfil_profesional', perfil_profesional.value);
        formData.append('email', email.value);
        formData.append('codigo', codigo);
        formData.append('especialidades',especialidades);

        spinner.show(btnGuardar);
        let res = await peticion.post('doctor', 'update', formData);
        spinner.hide(btnGuardar);
        switch (res.status) {
            case 400:
                res.body.forEach(({ input }) => {
                    errores.setById(input);
                });
                alerta.show('Debes ingresar datos válidos.', 'danger');
                break;
            case 200:
                window.location.href = 'index.php?controller=doctor';
                break;
            default:
                alerta.show('Error al intentar crear, por favor intenta más tarde.');
                console.error(res);
                break;
        }
    }

});