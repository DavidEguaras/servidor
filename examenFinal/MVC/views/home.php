<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h2>Lista de Coches</h2>
    <form method="get" action="index.php">
        <input type="text" name="marca" placeholder="Marca">
        <input type="text" name="modelo" placeholder="Modelo">
        <input type="text" name="descripcion" placeholder="Descripción">
        <input type="submit" name="filtrar" value="Filtrar">
    </form>
    <ul>
        <?php foreach ($coches as $coche) { ?>
            <li><?php echo $coche['marca'] . ' ' . $coche['modelo'] . ' - ' . $coche['precio']; ?></li>
        <?php } ?>
    </ul>
    <form method="post" action="index.php">
        <input type="submit" name="logOut" value="Cerrar sesión">
    </form>
</body>
</html>
