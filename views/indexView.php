


        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <form action="<?php echo "index.php?controller=paciente&action=create"; ?>" method="post">
                        <h2>Añadir Paciente</h2>
                        <hr />

                        <div class="form-group">
                            <label for="documento">Documento: </label>
                            <input type="text" class="form-control" id="documento" name="documento" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre: </label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="fecha_naciemiento">Fecha Nacimiento: </label>
                            <input type="date" class="form-control" id="fecha_naciemiento" name="fecha_naciemiento" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección: </label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="">
                        </div>

                        <div class="form-group">

                            <label for="telefono">Telefono: </label>
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="genero">Genero: </label>
                            <select class="form-control" id="genero" name="genero">
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>

                        <div class="form-group">

                            <label for="estado">Estado: </label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                                <option value="multado">Con multa</option>
                            </select>
                        </div>

                        <div class="form-group">

                            <label for="eps">EPS: </label>
                            <input type="text" class="form-control" id="eps" name="eps" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña: </label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="">
                        </div>

                        <button type="submit" class="btn btn-success">Guardar</button>

                    </form>
                </div>
                <div class="col-lg-8">
                    <div>
                        <h2>Pacientes</h2>
                        <hr />
                    </div>
                    <div class="row">
                        <div class="col-lg-2 ">Documento</div>
                        <div class="col-lg-3 ">Nombre</div>
                        <div class="col-lg-3 ">Telefono</div>
                        <div class="col-lg-2 ">Eps</div>
                        <div class="col-lg-2 ">Opciones</div>
                    </div>
                    <?php
                    if (isset($all_pacientes)) {
                        foreach ($all_pacientes as $row) {
                    ?>
                            <div class="row">
                                <div class="col-lg-2"><?php echo $row->documento ?></div>
                                <div class="col-lg-3"><?php echo $row->nombre; ?></div>
                                <div class="col-lg-3"><?php echo $row->telefono; ?></div>
                                <div class="col-lg-2"><?php echo $row->eps; ?></div>
                                <div class="col-lg-2">
                                    <div class="right col-1">
                                        <a href="<?php echo
                                                        "index.php?controller=Paciente&action=borrar&id=" . $row->documento; ?>" class="btn btn-danger">Borrar</a>
                                    </div>
                                </div>
                            </div><br>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div> <!-- row -->
            <br><br>
        </div>
