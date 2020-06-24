<div class="container">
    <div class="row justify-content-center">
        <h1 class="mt-2" >Especialidades</h1>
    </div>
    <div class="row justify-content-end">
        <a href="index.php?controller=especialidad&action=crear" class="btn btn-outline-primary">
            crear
        </a>
    </div>
    <div class="row justify-content-center table-responsive">
        <table class="table table-bordered mt-3 mb-2 text-center">
            <thead>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Opciones</th>
            </thead>
            <tbody id="tbody">
                <?php
                    if(isset($especialiadades)){
                        foreach ($especialiadades as $especialiadad) {
                ?>
                    <tr id="<?php echo $especialiadad->codigo; ?>">
                        <td><?php echo $especialiadad->codigo; ?></td>
                        <td><?php echo $especialiadad->nombre; ?></td>
                        <td><?php echo $especialiadad->descripcion; ?></td>
                       
                        <th>
                            <a class="btn btn-outline-primary btn-sm col-12 col-md-3" 
                                href="<?php echo URL?>?controller=especialidad&action=editar&especialiadad=<?php echo $especialiadad->codigo?>" >
                                <i class="fas fa-edit"></i>
                            </a>
                            &nbsp;
                            <button 
                                class="btn btn-outline-danger btn-sm col-12 col-md-3" 
                                onclick="eliminar(<?php echo $especialiadad->codigo; ?>)"
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
                        <td colspan="5">No hay especialidades registradas</td>
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
                        <h5 class="modal-title" id="eliminarLabel">¿Deseas eliminar la especialidad?</h5>
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
<script src="js/especialidad/index.js"></script>