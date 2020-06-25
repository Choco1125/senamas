<div class="container">
    <div class="row justify-content-center mt-3">
        <h1>Editar administrador</h1>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="card col-lg-5">
            <div class="card-body">
                <div class="form-group ">
                    <label for="documento">Documento</label>
                    <input type="text" name="documento" id="documento" class="form-control" placeholder="102030405" autofocus value="<? echo $admin->get_documento() ?>">
                </div>
                <div class="form-group">
                    <label for="email">Correo</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="admin@mail.com" value="<? echo $admin->get_email() ?>">
                </div>
                <button class="btn btn-outline-success col-12" id="guardar">Editar</button>
            </div>
        </div>
    </div>
</div>
<script src="js/admins/editar.js"></script>