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
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=login&action=log_out">Cerrar sesión</a>
            </li>
        </ul>
    </div>
</nav>