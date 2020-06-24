let botonLogin = document.getElementById('btn-login');
let email = document.getElementById('correo');
let contrasena = document.getElementById('contrasena');

botonLogin.addEventListener('click', async () =>{
    if(errores.isEmpty(email)){
        errores.setError(email);
    }
    if(errores.isEmpty(contrasena)){
        errores.setError(contrasena);
    }

    if(errores.count_errors() > 0){
        alerta.show('Debes llenar todos los campos','danger');
    }else{
        spinner.show(botonLogin);

        let formData =  new FormData();
        formData.append('email', email.value);
        formData.append('contrasena', contrasena.value);

        let res = await peticion.post('login','validate_login',formData);
        spinner.hide(botonLogin)


        switch (res.status) {
            case 400:
                res.body.forEach(({input}) => {
                    errores.setById(input);
                });
                alerta.show('Debes ingresar un correo válido.','danger');
                break;
            case 404:
                errores.setById('correo');
                alerta.show('Usuario no encontrado.','danger');
                break;
            case 406:
                errores.setById(res.body.input);
                alerta.show('La contraseña es incorrecta.','danger');
                break;
            case 200:
                window.location.href = 'index.php?controller=cita';
                break;
            default:
                console.log(res);
                break;
        }

    }


});
