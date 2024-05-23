<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="index.php" method="post">
        <label for="nombre">Nombre de usuario:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="pass">Contraseña:</label>
        <input type="password" id="pass" name="pass" required>
        <br>
        <input type="submit" name="login" value="Login">
    </form>
    <form action="index.php" method="post">
        <input type="submit" name="go_to_register" value="Registrarse">
    </form>
    <?php if (isset($errores['login'])): ?>
        <p style="color: red;"><?php echo $errores['login']; ?></p>
    <?php endif; ?>
</body>
</html>
