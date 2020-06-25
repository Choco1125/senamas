<div class="container">
    <div class="row justify-content-center mt-3">
        <h1>Crear cita</h1>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="card col-lg-8">
            <div class="card-body form-row">
                <div class="form-group col-md-5">
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Código" autofocus>
                </div>
                <div class="form-group col-md-7">
                    <label for="lugar">Lugar</label>
                    <input type="text" name="lugar" id="lugar" class="form-control" placeholder="Lugar">
                </div>
                <div class="form-group col-md-4">
                    <label for="consultorio">Consultorio</label>
                    <input type="text" name="consultorio" id="consultorio" class="form-control" placeholder="Consultorio">
                </div>
                <div class="form-group col-md-4">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" placeholder="Fecha">
                </div>
                <div class="form-group col-md-4">
                    <label for="hora">Hora</label>
                    <input type="time" name="hora" id="hora" class="form-control" placeholder="Hora">
                </div>
                <div class="form-group col-md-6 ">
                    <label for="doctor">Doctor</label>
                    <select name="doctor" id="doctor" class="custom-select">
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
                <div class="form-group col-md-6">
                    <label for="paciente">Documento del paciente</label>
                    <select name="paciente" id="paciente" class="custom-select">
                            <?php 
                                if(isset($pacientes)){
                                    foreach($pacientes as $paciente){
                            ?>
                                <option value="<? echo $paciente->documento ?>">
                                    <? echo $paciente->nombre ?>( <? echo $paciente->documento ?> )
                                </option>
                            <?php
                                    }
                                }
                            ?>
                    </select>
                    <!-- <input type="text" name="paciente" id="paciente" class="form-control" placeholder="Documento del paciente"> -->
                </div>
                
                <button class="btn btn-outline-success col-12" id="guardar">Crear</button>
            </div>
        </div>
    </div>
</div>
<script src="js/cita/crear.js"></script>