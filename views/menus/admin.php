<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="http://localhost/senamas/">Senamas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item dropdown <?php echo ($active == 'cita')?'active':'' ?>">
                <a class="nav-link dropdown-toggle" href="#" id="desple-citas" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Citas
                </a>
                <div class="dropdown-menu" aria-labelledby="desple-citas">
                    <a class="dropdown-item" href="index.php?controller=cita&action=crear">Crear</a>
                    <a class="dropdown-item" href="index.php?controller=cita">Ver</a>
                </div>
            </li>
            <li class="nav-item dropdown <?php echo ($active == 'doctor')?'active':'' ?>">
                <a class="nav-link dropdown-toggle" href="#" id="desple-doctores" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Doctores
                </a>
                <div class="dropdown-menu" aria-labelledby="desple-doctores">
                    <a class="dropdown-item" href="index.php?controller=doctor&action=crear">Crear</a>
                    <a class="dropdown-item" href="index.php?controller=doctor">Ver</a>
                </div>
            </li>
            <li class="nav-item dropdown <?php echo ($active == 'especialidad')?'active':'' ?>">
                <a class="nav-link dropdown-toggle" href="#" id="desple-especialidad" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Especialidad
                </a>
                <div class="dropdown-menu" aria-labelledby="desple-especialidad">
                    <a class="dropdown-item" href="index.php?controller=especialidad&action=crear">Crear</a>
                    <a class="dropdown-item" href="index.php?controller=especialidad">Ver</a>
                </div>
            </li>
            <li class="nav-item dropdown <?php echo ($active == 'paciente')?'active':'' ?>">
                <a class="nav-link dropdown-toggle" href="#" id="desple-pacientes" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pacientes
                </a>
                <div class="dropdown-menu" aria-labelledby="desple-pacientes">
                    <a class="dropdown-item" href="index.php?controller=paciente&action=crear">Crear</a>
                    <a class="dropdown-item" href="index.php?controller=paciente">Ver</a>
                </div>
            </li>
            <li class="nav-item dropdown <?php echo ($active == 'admins')?'active':'' ?>">
                <a class="nav-link dropdown-toggle" href="#" id="desple-pacientes" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Administradores
                </a>
                <div class="dropdown-menu" aria-labelledby="desple-pacientes">
                    <a class="dropdown-item" href="index.php?controller=admins&action=crear">Crear</a>
                    <a class="dropdown-item" href="index.php?controller=admins">Ver</a>
                </div>
            </li>
            <li class="nav-item dropdown <?php echo ($active == 'password')?'active':'' ?>">
                <a class="nav-link dropdown-toggle" href="#" id="desple-pacientes" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Cuenta
                </a>
                <div class="dropdown-menu" aria-labelledby="desple-pacientes">
                    <a class="dropdown-item" href="index.php?controller=admins&action=editar&admin=<?echo $_SESSION['id']?>">Mis datos</a>
                    <a class="dropdown-item" href="index.php?controller=password">Cambiar contraseña</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=login&action=log_out">Cerrar sesión</a>
            </li>
        </ul>
    </div>
</nav>