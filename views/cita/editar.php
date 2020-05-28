<div class="container">
    <div class="row justify-content-center mt-3">
        <h1>Editar cita</h1>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="card col-lg-8">
            <div class="card-body form-row">
                <div class="form-group col-md-5">
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Código" autofocus value="<?php echo $cita->get_codCita();?>">
                </div>
                <div class="form-group col-md-7">
                    <label for="lugar">Lugar</label>
                    <input type="text" name="lugar" id="lugar" class="form-control" placeholder="Lugar" value="<?php echo $cita->get_lugar();?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="consultorio">Consultorio</label>
                    <input type="text" name="consultorio" id="consultorio" class="form-control" placeholder="Consultorio" value="<?php echo $cita->get_consultorio();?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" placeholder="Fecha" value="<?php echo $cita->get_fecha();?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="hora">Hora</label>
                    <input type="time" name="hora" id="hora" class="form-control" placeholder="Hora" value="<?php echo $cita->get_hora();?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="doctor">Doctor</label>
                    <select name="doctor" id="doctor" class="custom-select">
                        <?php
                            if(isset($medicos)){
                                foreach($medicos as $doctor){
                        ?>
                                    <option value="<?php echo $doctor->codigo;?>" <?php echo $cita->get_doctor() == $doctor->codigo?'selected':''; ?>>
                                        <?php echo $doctor->nombre .'-'. $doctor->codigo;?>
                                    </option>
                        <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="paciente">Documento del paciente</label>
                    <input type="text" name="paciente" id="paciente" class="form-control" placeholder="Documento del paciente" value="<?php echo $cita->get_paciente();?>">
                </div>
                
                <button class="btn btn-outline-success col-12" id="guardar">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<script src="js/cita/editar.js"></script>
