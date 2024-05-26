<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card border-0">
                    <div class="card-body login-box bg-black">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="usernameRegister" class="text-info">Nombre de usuario:</label>
                                <input type="text" class="form-control" id="usernameRegister" name="usernameRegister">
                                <?php if (isset($errors)) { writeErrors($errors, 'usernameRegister'); } ?>
                            </div>
                            <div class="form-group">
                                <label for="name" class="text-info mt-3">Nombre completo:</label>
                                <input type="text" class="form-control" id="name" name="name">
                                <?php if (isset($errors)) { writeErrors($errors, 'name'); } ?>
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info mt-3">Correo electrónico:</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <?php if (isset($errors)) { writeErrors($errors, 'email'); } ?>
                            </div>
                            <div class="form-group">
                                <label for="passwordRegister" class="text-info mt-3">Contraseña:</label>
                                <input type="password" class="form-control" id="passwordRegister" name="passwordRegister">
                                <?php if (isset($errors)) { writeErrors($errors, 'passwordRegister'); } ?>
                            </div>
                            <div class="mt-3">
                                <button type="submit" name="registerSubmit" class="btn btn-primary">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
