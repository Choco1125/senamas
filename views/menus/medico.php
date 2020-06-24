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
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=login&action=log_out">Cerrar sesión</a>
            </li>
        </ul>
    </div>
</nav>