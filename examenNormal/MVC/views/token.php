<!DOCTYPE html>
<html>
<head>
    <title>Token</title>
</head>
<body>
    <h2>Registro Exitoso</h2>
    <p>Tu token de acceso es: <?php echo $_SESSION['token']; ?></p>
    <p>El token caduca en 10 días.</p>
    <a href="index.php">Volver a iniciar sesión</a>
</body>
</html>
