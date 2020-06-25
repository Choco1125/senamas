<div class="container">
    <div class="row justify-content-center">
        <h1 class="mt-2" >Administradores</h1>
    </div>
    <div class="row justify-content-end">
        <a href="index.php?controller=admins&action=crear" class="btn btn-outline-primary">
            crear
        </a>
    </div>
    <div class="row justify-content-center table-responsive">
        <table class="table table-bordered mt-3 mb-2 text-center">
            <thead>
                <th scope="col">Documento</th>
                <th scope="col">Email</th>
                <th scope="col">Opciones</th>
            </thead>
            <tbody id="tbody">
                <?php
                    if(isset($admins)){
                        foreach ($admins as $admin) {
                ?>
                    <tr id="<?php echo $admin->documento; ?>">
                        <td><?php echo $admin->documento; ?></td>
                        <td><?php echo $admin->email; ?></td>
                       
                        <th>
                            <a class="btn btn-outline-primary btn-sm col-12 col-md-3" 
                                href="<?php echo URL?>?controller=admins&action=editar&admin=<?php echo $admin->documento?>" >
                                <i class="fas fa-edit"></i>
                            </a>
                            &nbsp;
                            <button 
                                class="btn btn-outline-danger btn-sm col-12 col-md-3" 
                                onclick="eliminar(<?php echo $admin->documento; ?>)"
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
                        <td colspan="5">No hay administradores registrados</td>
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
                        <h5 class="modal-title" id="eliminarLabel">¿Deseas eliminar el administrador?</h5>
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
<script src="js/admins/index.js"></script>