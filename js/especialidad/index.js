let codigo = '';
let tbody = document.getElementById('tbody');

const eliminar = valor => codigo = valor;

const getTr = id => document.getElementById(id);

let btnEliminar = document.getElementById('btn-eliminar');

btnEliminar.addEventListener('click', async function(){
    let formData = new FormData();
    formData.append('codigo',codigo);

    spinner.show(btnEliminar);
    let res = await peticion.post('especialidad','delete',formData);
    switch (res.status) {
        case 400:
        case 500:
            $('#eliminar').modal('hide');
            alerta.show(res.body,'danger');
            break;
        case 200:
            tbody.removeChild(getTr(codigo));
            $('#eliminar').modal('hide');
            alerta.show(res.body,'success');
            break;
        default:
            console.log(res);
            break;
    }
    spinner.hide(btnEliminar);
});