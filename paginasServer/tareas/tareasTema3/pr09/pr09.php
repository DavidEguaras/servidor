<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="validarpr09.php" method="post">
        <label>Nombre: </label>
        <input type="text" name="nombre" value="Nombre"><br>

        <label>Apellidos</label>
        <input type="text" name="apellidos" value="Apellidos"><br>

        <label>Contraseña</label>
        <input type="password" name="password" value="Password"><br>

        <label>Repetir Contraseña</label>
        <input type="password" name="repetirContrasena" value="repetirContrasena"><br>
        
        <label>Fecha</label>
        <input type="text" name="fecha" value="Fecha"><br>

        <label for="dni">DNI (8 dígitos y una letra):</label>
        <input type="text" id="dni" name="dni">
        <br>

        <label>Correo</label>
        <input type="email" name="email" value="Email"><br>

        <label>Imagen de Perfil: </label>
        <input type="file" name="imagenPerfil" value="ImagenPerfil"><br>

        <input type="submit" value="submit">

    </form>
</body>
</html>