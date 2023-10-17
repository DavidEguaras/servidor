
<?php
$dimensionArray = 4;

// Inicializar el array
$tabla = array();

// Llenar el array según el patrón
for ($i = 0; $i < $dimensionArray; $i++) {
    for ($j = 0; $j < $dimensionArray; $j++) {
        if ($i == 0 || $j == 0) {
            // Si estamos en la primera fila o primera columna, asignar 1
            $tabla[$i][$j] = 1;
        } else {
            //el numero de la posicion tabla[i][j] es la suma del elemento de arriba y el de la izquierda
            $tabla[$i][$j] = ($tabla[$i - 1][$j]) + ($tabla[$i][$j - 1]);
        }
    }
}
?>

<table border = "1">
    <tbody>
    <?php
        foreach ($tabla as $key => $value) {
                foreach ($value as $resultado) {
                    echo "<td>$resultado</td>";
                }
            echo "</tr>";
        }
    ?>
    </tbody>
</table>