<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="http://localhost/senamas/">Senamas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item <?php echo ($active == 'cita')?'active':'' ?>">
                <a class="nav-link" href="index.php?controller=cita">Citas</a>
            </li>
            <li class="nav-item dropdown <?php echo ($active == 'admins')?'active':'' ?>">
                <a class="nav-link dropdown-toggle" href="#" id="desple-pacientes" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Cuenta
                </a>
                <div class="dropdown-menu" aria-labelledby="desple-pacientes">
                    <a class="dropdown-item" href="index.php?controller=doctor&action=editar&medico=<?echo $_SESSION['id']?>">Mis datos</a>
                    <a class="dropdown-item" href="index.php?controller=admins">Ver</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=login&action=log_out">Cerrar sesión</a>
            </li>
        </ul>
    </div>
</nav>