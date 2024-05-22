<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card border-0">
                    <div class="card-body login-box bg-black">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="login" class="text-info">Nombre de usuario:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="login" name="nombre" value="<?php if(isset($_COOKIE['username'])) echo $_COOKIE['username']?>">
                                </div>
                                <?php if (isset($errores)) { escribirErrores($errores, 'nombre'); } ?>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info mt-5">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="pass">
                                <?php if (isset($errores)) { escribirErrores($errores, 'pass'); } ?>
                            </div>
                            <div class="form-check mt-3">
                                <input type="checkbox" class="form-check-input" id="recordar" name="recordar" <?php if (isset($_COOKIE['username'])) echo 'checked'; ?>>
                                <label class="form-check-label text-info" for="recordar">Recordar sesión</label>
                            </div>
                            <?php if (isset($errores)) { escribirErrores($errores, 'validado'); } ?>
                            <div class="mt-3">
                                <button type="submit" name="login" class="btn btn-primary">Iniciar sesión</button>
                                <button type="submit" name="registrar" class="btn btn-secondary">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
