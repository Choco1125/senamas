<div class="container">
    <div class="row justify-content-center">
        <h1 class="mt-2" >Citas</h1>
    </div>
    <div class="row justify-content-end  <? echo $_SESSION['rol'] == 'paciente' || $_SESSION['rol'] == 'medico'? 'd-none':''?>">
        <a href="index.php?controller=cita&action=crear" class="btn btn-outline-primary">
            crear
        </a>
    </div>
    <div class="row form-row justify-content-aroun mt-2 <? echo $_SESSION['rol'] == 'paciente' ? 'd-none':''?>">
        <div class="col-md-3 col-10 <? echo $_SESSION['rol']!= 'admin'? 'd-none':''?>">
            <select name="medico" id="medico" class="custom-select">
                <option value="<? echo $_SESSION['rol']== 'medico'? $_SESSION['id']:''?>">Selecciona un doctor</option>
                <?php 
                    if(isset($medicos)){
                        foreach($medicos as $doctor){
                ?>
                            <option value="<?php echo $doctor->codigo;?>">
                                <?php echo $doctor->nombre .'-'. $doctor->codigo;?>
                            </option>
                <?php
                        }
                    }
                ?>
            </select>
        </div>
        <div class="col-md-3 col-10">
            <input type="date" id="fecha" class="form-control">
        </div>
        <div class="col-1">
            <button class="btn btn-outline-primary" id="btn-buscar"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="row justify-content-center table-responsive">
        <table class="table table-bordered mt-3 mb-2 text-center">
            <thead>
                <th scope="col">Codigo</th>
                <th scope="col">Lugar</th>
                <th scope="col">Consultorio</th>
                <th scope="col">Doctor</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Paciente</th>
                <th scope="col" class="<? echo $_SESSION['rol'] == 'paciente' || $_SESSION['rol'] == 'medico'? 'd-none':''?>">Opciones</th>
            </thead>
            <tbody id="tbody">
                <?php
                    if(isset($citas)){
                        foreach ($citas as $cita) {
                ?>
                    <tr id="<?php echo $cita->codCita; ?>">
                        <td><?php echo $cita->codCita; ?></td>
                        <td><?php echo $cita->lugar; ?></td>
                        <td><?php echo $cita->consultorio; ?></td>
                        <td><?php echo $cita->doctor; ?></td>
                        <td><?php echo $cita->fecha; ?></td>
                        <td><?php echo $cita->hora; ?></td>
                        <td><?php echo $cita->paciente; ?></td>
                        <th class="<? echo $_SESSION['rol'] == 'paciente' || $_SESSION['rol'] == 'medico'? 'd-none':''?>">
                            <a class="btn btn-outline-primary btn-sm " 
                                href="<?php echo URL?>?controller=cita&action=editar&cita=<?php echo $cita->codCita?>" >
                                <i class="fas fa-edit"></i>
                            </a>
                            &nbsp;
                            <button 
                                class="btn btn-outline-danger btn-sm " 
                                onclick="eliminar(<?php echo $cita->codCita; ?>)"
                                data-toggle="modal" data-target="#eliminar"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        </th>
                    </tr>
                <?php
                        }
                    }else{
                ?>
                    <tr>
                        <td colspan="8">No hay citas registradas</td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>

        <div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="eliminarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminarLabel">¿Deseas la cita?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-outline-danger" id="btn-eliminar">Sí, eliminar </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/cita/index.js"></script>