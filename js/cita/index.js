let documento = '';
let tbody = document.getElementById('tbody');

const eliminar = usuario => documento = usuario;

const getTr = id => document.getElementById(id);

let btnEliminar = document.getElementById('btn-eliminar');

btnEliminar.addEventListener('click', async function(){
    let formData = new FormData();
    formData.append('codCita',documento);

    spinner.show(btnEliminar);
    let res = await peticion.post('cita','delete',formData);
    console.log(res)
    switch (res.status) {
        case 400:
        case 500:
            $('#eliminar').modal('hide');
            alerta.show(res.body,'danger');
            break;
        case 200:
            tbody.removeChild(getTr(documento));
            $('#eliminar').modal('hide');
            alerta.show(res.body,'success');
            break;
        default:
            console.log(res);
            break;
    }
    spinner.hide(btnEliminar);
});