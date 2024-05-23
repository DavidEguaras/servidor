<?php
session_start();

// Inicializar la palabra y las variables del juego si no están establecidas
if (!isset($_SESSION['palabra'])) {
    $_SESSION['palabra'] = 'ejemplo'; // La palabra a adivinar
    $_SESSION['letras_adivinadas'] = [];
    $_SESSION['intentos'] = 6; // Número de intentos permitidos
}

// Función para mostrar el estado actual de la palabra
function mostrar_palabra($palabra, $letras_adivinadas) {
    $mostrar = '';
    for ($i = 0; $i < strlen($palabra); $i++) {
        if (in_array($palabra[$i], $letras_adivinadas)) {
            $mostrar .= $palabra[$i];
        } else {
            $mostrar .= '_';
        }
    }
    return $mostrar;
}

// Procesar la letra ingresada por el usuario
if (isset($_POST['letra'])) {
    $letra = $_POST['letra'];
    if (!in_array($letra, $_SESSION['letras_adivinadas'])) {
        $_SESSION['letras_adivinadas'][] = $letra;
        if (strpos($_SESSION['palabra'], $letra) === false) {
            $_SESSION['intentos']--;
        }
    }
}

// Comprobar si el juego ha terminado
$palabra_mostrada = mostrar_palabra($_SESSION['palabra'], $_SESSION['letras_adivinadas']);
if ($palabra_mostrada == $_SESSION['palabra']) {
    echo "<h1>¡Has ganado! La palabra era '{$_SESSION['palabra']}'</h1>";
    session_destroy();
    echo "<a href='ahorcado.php'>Jugar de nuevo</a>";
    exit;
} elseif ($_SESSION['intentos'] <= 0) {
    echo "<h1>¡Has perdido! La palabra era '{$_SESSION['palabra']}'</h1>";
    session_destroy();
    echo "<a href='ahorcado.php'>Jugar de nuevo</a>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego del Ahorcado</title>
</head>
<body>
    <h1>Juego del Ahorcado</h1>
    <p>Palabra: <?php echo $palabra_mostrada; ?></p>
    <p>Intentos restantes: <?php echo $_SESSION['intentos']; ?></p>
    <form method="post" action="">
        <label for="letra">Ingresa una letra:</label>
        <input type="text" id="letra" name="letra" maxlength="1" required>
        <button type="submit">Adivinar</button>
    </form>
</body>
</html>
