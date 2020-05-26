<div class="container">
    <div class="row justify-content-center mt-3">
        <h1>Crear médico</h1>
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
                <div class="form-group col-md-4">
                    <label for="fecha_naciemiento">Fecha nacimiento</label>
                    <input type="date" name="fecha_naciemiento" id="fecha_naciemiento" class="form-control" placeholder="Fecha nacimiento">
                </div>
                <div class="form-group col-md-4">
                    <label for="fecha_ingreso">Fecha ingreso</label>
                    <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" placeholder="Fecha nacimiento">
                </div>
                <div class="form-group col-md-4">
                    <label for="genero">Género</label>
                    <select name="genero" id="genero" class="custom-select">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
                <div class="form-group col-md-8">
                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Correo">
                </div>
                <div class="form-group col-md-4">
                    <label for="anos_experiencia">Años de experiencia</label>
                    <input type="number" name="anos_experiencia" id="anos_experiencia" class="form-control" min="1" value="1" max="70">
                </div>
                <div class="form-group col-md-12">
                    <label for="perfil_profesional">Perfil profesional</label>
                    <textarea name="perfil_profesional" id="perfil_profesional" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <h5>Especialidades</h5>
                </div>
                <button class="btn btn-outline-success col-12" id="guardar">Crear</button>
            </div>
        </div>
    </div>
</div>
<script src="js/medico/crear.js"></script>