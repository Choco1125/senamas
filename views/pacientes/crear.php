<div class="container">
    <div class="row justify-content-center mt-3">
        <h1>Crear paciente</h1>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="card col-lg-8">
            <div class="card-body form-row">
                <div class="form-group col-md-5">
                    <label for="documento">Documento</label>
                    <input type="text" name="documento" id="documento" class="form-control" placeholder="Documento" autofocus>
                </div>
                <div class="form-group col-md-7">
                    <label for="nombre">Nombres</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres">
                </div>
                <div class="form-group col-md-6">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección">
                </div>
                <div class="form-group col-md-6">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" name="telefono" id="telefono" class="form-control" placeholder="Teléfono">
                </div>
                <div class="form-group col-md-4">
                    <label for="fecha_naciemiento">Fecha nacimiento</label>
                    <input type="date" name="fecha_naciemiento" id="fecha_naciemiento" class="form-control" placeholder="Fecha nacimiento">
                </div>
                <div class="form-group col-md-4">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="custom-select">
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                        <option value="multado">Con multa</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="genero">Género</label>
                    <select name="genero" id="genero" class="custom-select">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="eps">EPS</label>
                    <input type="text" name="eps" id="eps" class="form-control" placeholder="EPS">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Correo">
                </div>
                <button class="btn btn-outline-success col-12" id="guardar">Crear</button>
            </div>
        </div>
    </div>
</div>
<script src="js/pacientes.js"></script>