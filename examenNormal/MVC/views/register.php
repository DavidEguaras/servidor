<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form action="index.php" method="post">
        <label for="nombre">Nombre de usuario:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="nombre_completo">Nombre Completo:</label>
        <input type="text" id="nombre_completo" name="nombre_completo" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="pass">Contraseña:</label>
        <input type="password" id="pass" name="pass" required>
        <br>
        <input type="submit" name="register" value="Registrarse">
        <input type="submit" name="cancelar" value="Cancelar">
    </form>
    <?php if (isset($errores['api'])): ?>
        <p style="color: red;"><?php echo $errores['api']; ?></p>
    <?php endif; ?>
</body>
</html>
