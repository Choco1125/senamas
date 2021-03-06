<div class="container">
    <div class="row justify-content-center mt-3">
        <h1>Editar especialidad</h1>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="card col-lg-5">
            <div class="card-body">
                <div class="form-group ">
                    <label for="codigo">Código</label>
                    <input type="number" name="codigo" id="codigo" class="form-control" placeholder="Código" autofocus min="0" value="<?php  echo $especialiad->get_codigo()?>">
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" value="<?php  echo $especialiad->get_nombre()?>">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción"><?php  echo $especialiad->get_descripcion()?></textarea>
                </div>
                <button class="btn btn-outline-success col-12" id="guardar">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<script src="js/especialidad/editar.js"></script>
