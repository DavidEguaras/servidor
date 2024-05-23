    <form action="index.php" method="post" >
        <input class="mt-5" type="submit" name="logOut" value="logOut">
    </form>

    <table border="1">
        <tr>
            <th>id</th>
            <th>jug1</th>
            <th>jug2</th>
            <th>fecha</th>
            <th>resultado</th>
        </tr>
        <?php if (is_array($_SESSION['partidos'])): ?>
            <?php foreach ($_SESSION['partidos'] as $partido): ?>
                <?php if (is_array($partido)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($partido['id']); ?></td>
                        <td><?php echo htmlspecialchars($partido['jug1']); ?></td>
                        <td><?php echo htmlspecialchars($partido['jug2']); ?></td>
                        <td><?php echo htmlspecialchars($partido['fecha']); ?></td>
                        <td><?php echo htmlspecialchars($partido['resultado']); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No hay partidos disponibles.</td>
            </tr>
        <?php endif; ?>
    </table>



        <?php if ($_SESSION['usuario'] -> perfil=="admin"):?>
            <h2>Listado de partidos</h2>
        <form action="index.php" method="post">
            <label for="jug1">jug1:</label>
            <input type="text" id="jug1" name="jug1">
            <br>
            <label for="jug2">jug2:</label>
            <input type="jug2" id="jug2" name="jug2">
            <br>
            <label for="fecha">fecha:</label>
            <input type="fecha" id="fecha" name="fecha">
            <br>
            <label for="resultado">resultado:</label>
            <input type="resultado" id="resultado" name="resultado">
            <br>
            <input type="submit" name="nuevo_partido" value="Agregar">
        </form>
        <?php endif;?> 