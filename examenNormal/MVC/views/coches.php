<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Coches</title>
</head>
<body>
    <h2>Listado de Coches</h2>
    <form action="index.php" method="post">
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo">
        <br>
        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca">
        <br>
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion">
        <br>
        <input type="submit" name="filtrar" value="Filtrar">
    </form>
    <table border="1">
        <tr>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Descripción</th>
            <th>Precio</th>
        </tr>
        <?php if (is_array($_SESSION['coches'])): ?>
            <?php foreach ($_SESSION['coches'] as $coche): ?>
                <?php if (is_array($coche)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($coche['modelo']); ?></td>
                        <td><?php echo htmlspecialchars($coche['marca']); ?></td>
                        <td><?php echo htmlspecialchars($coche['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($coche['precio']); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No hay coches disponibles.</td>
            </tr>
        <?php endif; ?>
    </table>
    <?php if (isset($_SESSION['usuario']) && @$_SESSION['usuario']['rol'] == 'admin'): ?>
        <h3>Añadir Nuevo Coche</h3>
        <form action="index.php" method="post">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required>
            <br>
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required>
            <br>
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" required>
            <br>
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" required>
            <br>
            <input type="submit" name="nuevo_coche" value="Añadir Coche">
        </form>
    <?php endif; ?>
    <form action="index.php" method="post">
        <input type="submit" name="ir_home" value="Volver a Home">
    </form>
</body>
</html>
