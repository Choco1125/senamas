<div class="container">
    <div class="row justify-content-center mt-3">
        <h1>Editar médico</h1>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="card col-lg-8">
            <div class="card-body form-row">
                <div class="form-group col-md-5">
                    <label for="documento">Documento</label>
                    <input type="text" name="documento" id="documento" class="form-control" placeholder="Documento" autofocus value="<?php echo $medico->get_documento()?>">
                </div>
                <div class="form-group col-md-7">
                    <label for="nombre">Nombres</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres" value="<?php echo $medico->get_nombre()?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="fecha_naciemiento">Fecha nacimiento</label>
                    <input type="date" name="fecha_naciemiento" id="fecha_naciemiento" class="form-control" placeholder="Fecha nacimiento" value="<?php echo $medico->get_fecha_nacimiento()?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="fecha_ingreso">Fecha ingreso</label>
                    <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" placeholder="Fecha nacimiento"value="<?php echo $medico->get_fecha_ingreso()?>" <? echo $_SESSION['rol'] != 'admin'?'disabled':'' ?>>
                </div>
                <div class="form-group col-md-4">
                    <label for="genero">Género</label>
                    <select name="genero" id="genero" class="custom-select">
                        <option value="M" <?php echo ($medico->get_genero() == 'M')?'selected':'' ?>>Masculino</option>
                        <option value="F" <?php echo ($medico->get_genero() == 'F')?'selected':'' ?>>Femenino</option>
                    </select>
                </div>
                <div class="form-group col-md-8">
                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Correo" value="<?php echo $medico->get_email()?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="anos_experiencia">Años de experiencia</label>
                    <input type="number" name="anos_experiencia" id="anos_experiencia" class="form-control" min="1" value="<?php echo $medico->get_anos_experiencia()?>" max="70">
                </div>
                <div class="form-group col-md-12">
                    <label for="perfil_profesional">Perfil profesional</label>
                    <textarea name="perfil_profesional" id="perfil_profesional" class="form-control"><?php echo $medico->get_perfil_profesional()?></textarea>
                </div>
                <div class="form-group col-md-12">
                    <h5>Especialidades</h5>
                    <?php
                        if(isset($especialidades)){
                            foreach($especialidades as $especialidad){
                    ?>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="<?php echo $especialidad->codigo?>" <?php echo in_array($especialidad->codigo,$mis_especialidades)?'checked':'' ?> <? echo $_SESSION['rol'] != 'admin'?'disabled':'' ?>>
                            <label class="custom-control-label" for="<?php echo $especialidad->codigo?>"><?php echo $especialidad->nombre?></label>
                        </div>
                    <?php
                            }
                        }
                    ?>
                </div>
                <button class="btn btn-outline-success col-12" id="guardar">Actualizar</button>
            </div>
        </div>
    </div>
</div>


<script src="js/medico/editar.js"></script>