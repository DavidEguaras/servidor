<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="index.php">
        <input type="text" name="nombre" placeholder="Nombre de usuario" required>
        <input type="password" name="pass" placeholder="Token" required>
        <input type="submit" name="login" value="Iniciar sesión">
    </form>
    <a href="index.php?registerForm=true">Registrarse</a>
</body>
</html>
