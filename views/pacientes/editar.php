<div class="container">
    <div class="row justify-content-center mt-3">
        <h1>Editar paciente</h1>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="card col-lg-8">
            <div class="card-body form-row">
                <div class="form-group col-md-5">
                    <label for="documento">Documento</label>
                    <input type="text" name="documento" id="documento" class="form-control" placeholder="Documento" autofocus value="<?php echo $obj_paciente->get_documento() ?>">
                </div>
                <div class="form-group col-md-7">
                    <label for="nombre">Nombres</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres" value="<?php echo $obj_paciente->get_nombre() ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección" value="<?php echo $obj_paciente->get_direccion() ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" name="telefono" id="telefono" class="form-control" placeholder="Teléfono" value="<?php echo $obj_paciente->get_telefono() ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="fecha_naciemiento">Fecha nacimiento</label>
                    <input type="date" name="fecha_naciemiento" id="fecha_naciemiento" class="form-control" placeholder="Fecha nacimiento" value="<?php echo $obj_paciente->get_fecha_naciemiento() ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="custom-select" <? echo $_SESSION['rol'] != 'admin' ? 'disabled':'' ?>>
                        <option value="activo" <?php echo $obj_paciente->get_estado() == 'activo'?'selected':'' ?>>Activo</option>
                        <option value="inactivo" <?php echo $obj_paciente->get_estado() == 'inactivo'?'selected':'' ?>>Inactivo</option>
                        <option value="multado" <?php echo $obj_paciente->get_estado() == 'multado'?'selected':'' ?>>Con multa</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="genero">Género</label>
                    <select name="genero" id="genero" class="custom-select">
                        <option value="M" <?php echo $obj_paciente->get_genero() == 'M' ? 'selected':'' ?>>Masculino</option>
                        <option value="F" <?php echo $obj_paciente->get_genero() == 'F' ? 'selected':'' ?>>Femenino</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="eps">EPS</label>
                    <input type="text" name="eps" id="eps" class="form-control" placeholder="EPS" value="<?php echo $obj_paciente->get_eps()?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Correo" value="<?php echo $obj_paciente->get_email()?>">
                </div>
                <button class="btn btn-outline-success col-12" id="guardar">Editar</button>
            </div>
        </div>
    </div>
</div>
<script src="js/paciente/editar.js"></script>