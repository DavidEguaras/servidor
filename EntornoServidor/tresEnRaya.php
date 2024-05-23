<?php
session_start();

// Inicializar el tablero y las variables del juego si no están establecidas
if (!isset($_SESSION['tablero'])) {
    $_SESSION['tablero'] = array_fill(0, 9, '');
    $_SESSION['turno'] = 'X'; // El primer jugador será 'X'
}

// Función para comprobar si hay un ganador
function comprobar_ganador($tablero) {
    $ganador = '';
    $lineas_ganadoras = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8], // Filas
        [0, 3, 6], [1, 4, 7], [2, 5, 8], // Columnas
        [0, 4, 8], [2, 4, 6]             // Diagonales
    ];

    foreach ($lineas_ganadoras as $linea) {
        if ($tablero[$linea[0]] === $tablero[$linea[1]] && $tablero[$linea[1]] === $tablero[$linea[2]] && $tablero[$linea[0]] !== '') {
            $ganador = $tablero[$linea[0]];
            break;
        }
    }

    return $ganador;
}

// Procesar el movimiento del jugador
if (isset($_POST['posicion']) && $_SESSION['tablero'][$_POST['posicion']] === '') {
    $posicion = $_POST['posicion'];
    $_SESSION['tablero'][$posicion] = $_SESSION['turno'];
    $_SESSION['turno'] = ($_SESSION['turno'] === 'X') ? 'O' : 'X';
}

// Comprobar si hay un ganador
$ganador = comprobar_ganador($_SESSION['tablero']);

// Comprobar si hay empate
$empate = !in_array('', $_SESSION['tablero'], true) && $ganador === '';

if ($ganador !== '') {
    echo "<h1>¡El jugador '$ganador' ha ganado!</h1>";
    session_destroy();
    echo "<a href='tresenraya.php'>Jugar de nuevo</a>";
    exit;
} elseif ($empate) {
    echo "<h1>¡Es un empate!</h1>";
    session_destroy();
    echo "<a href='tresenraya.php'>Jugar de nuevo</a>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tres en Raya</title>
    <style>
        table {
            border-collapse: collapse;
        }
        td {
            width: 60px;
            height: 60px;
            text-align: center;
            font-size: 24px;
            border: 1px solid #000;
        }
        button {
            width: 100%;
            height: 100%;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <h1>Tres en Raya</h1>
    <form method="post" action="">
        <table>
            <?php for ($i = 0; $i < 9; $i++): ?>
                <?php if ($i % 3 === 0): ?>
                    <tr>
                <?php endif; ?>
                <td>
                    <?php if ($_SESSION['tablero'][$i] === ''): ?>
                        <button type="submit" name="posicion" value="<?php echo $i; ?>"></button>
                    <?php else: ?>
                        <?php echo $_SESSION['tablero'][$i]; ?>
                    <?php endif; ?>
                </td>
                <?php if ($i % 3 === 2): ?>
                    </tr>
                <?php endif; ?>
            <?php endfor; ?>
        </table>
    </form>
</body>
</html>
