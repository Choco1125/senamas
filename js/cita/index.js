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

function clear_table() {
    tbody.innerHTML = '';
}

function is_hiden() {
    let ths = document.getElementsByTagName('th');
    ultimoTh = ths.item(ths.length - 1);
    return ultimoTh.getAttribute('class') == 'd-none';
    
}

function add_to_table(cita) {
    let tr = document.createElement('tr');
    for(let key in cita){
        let td = document.createElement('td');
        td.innerHTML = cita[key];
        tr.appendChild(td);
    }
    if(!is_hiden()){
        let td = document.createElement('td');
        td.innerHTML = `
        <a class="btn btn-outline-primary btn-sm " 
        href="index.php?controller=cita&action=editar&cita=${cita.codCita}" >
            <i class="fas fa-edit"></i>
        </a>
        &nbsp;
        <button 
            class="btn btn-outline-danger btn-sm " 
            onclick="eliminar(${cita.codCita})"
            data-toggle="modal" data-target="#eliminar"
        >
            <i class="fas fa-trash"></i>
        </button>
        `;
        tr.appendChild(td);
    }
    tbody.appendChild(tr);
}

//{codCita,consultorio,doctor,fecha,hora,lugar,paciente}

let btnBuscar = document.getElementById('btn-buscar');
btnBuscar.addEventListener('click',async ()=>{
    let doctor = document.getElementById('medico').value;
    let fecha = document.getElementById('fecha').value;

    if(doctor == "" && fecha == ""){
        alerta.show('Debes ingresar un parámetro de búsqueda','warning');
    }else{
        let formData = new FormData();
        formData.append('doctor',doctor);
        formData.append('fecha',fecha);

        let res =  await peticion.post('cita','filtrar',formData);

        if(res.citas == null){
            alerta.show('No hay información para mostrar','warning');
        }else{
            clear_table();
            res.citas.forEach(cita => {
                add_to_table(cita);
            });
        }
    }
});