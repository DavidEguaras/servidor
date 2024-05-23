vale , <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Agrega los enlaces a los archivos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
            <span class="input-group-text">
                <img src="<?php echo IMG . 'LogoTienda.png'; ?>" class="card-img-top img-fluid" alt="Imagen" style="width: 150px;">
                <h2 class="card-title text-center fw-bold align-self-center mx-5">Inicio de Sesión</h2>
            </span>
                    <form action="" method="post">
                    <div class="mb-3 mx-3">
                        <label for="nombre" class="form-label">Nombre de usuario:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nombre" name="username" value="<?php if(isset($_COOKIE['username'])) echo $_COOKIE['username']?>">
                        </div>
                        <?php if (isset($errores)) { printerror($errores, 'username'); } ?>
                    </div>
                        <div class="mb-3 mx-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <?php if (isset($errores)) { printerror($errores, 'password'); } ?>
                        </div>
                        <div class="mb-3 form-check mx-3">
                            <input type="checkbox" class="form-check-input" id="recordar" name="recordar" <?php if (isset($_COOKIE['username'])) echo 'checked'; ?>>
                            <label class="form-check-label" for="recordar">Recordar sesión</label>
                        </div>
                        <button type="submit" class="btn btn-primary mx-3 ">Iniciar sesión</button>
                    </form>
                    <?php if (!empty($errores['login'])) { echo '<p class="text-danger mt-3">' . $errores['login'] . '</p>'; } ?>
                    <p class="mt-3">¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html> 
