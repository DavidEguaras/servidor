<div class="row">
    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card mb-4 mt-4 d-flex justify-content-center flex-fill">
            <div class="d-flex justify-content-center">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                     class="rounded-circle img-fluid ms-auto mx-auto mt-1" style="width: 150px;">
            </div>
            <div class="card-body text-center">
                <h5 class="my-3"><?php echo $_SESSION['usuario']['Nombre']; ?></h5>
                <p class="text-muted mb-1"><?php echo $_SESSION['usuario']['Email']; ?></p>
                <div class="d-flex justify-content-center mb-2">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card mb-4 mt-4 d-flex justify-content-center border flex-fill">
            <h3 class="cambiarDatos text text-center fw-bold mt-2">Cambiar datos</h3>
            <form action="">
                <div class="row d-flex justify-content-around text-center mb-3">
                    <div class="col-5 mx-1">
                        <div class="mb-3">
                            <label for="nuevoNombre" class="form-label">Nombre :</label>
                            <input type="text" class="form-control text-center" id="nuevoNombre" aria-describedby="newName" value="<?php echo $_SESSION['usuario']['Nombre']; ?>" name="nuevo_nombre">
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="mb-3">
                            <label for="nuevoEmail" class="form-label">Email :</label>
                            <input type="email" class="form-control text-center" id="nuevoEmail" aria-describedby="newEmail" value="<?php echo $_SESSION['usuario']['Email']; ?>" name="nuevo_email">
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-end">
                    <div class="col-3 text-end mx-5 mb-3">
                        <input class="btn btn-dark " type="submit" value="Aplicar Cambios" name="user_cambios">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

