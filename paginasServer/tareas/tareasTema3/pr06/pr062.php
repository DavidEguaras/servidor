
<?php
$liga = array(
    "Zamora" =>  array(
        "Salamanca" => array(
            "Resultado" => "3-2", "Roja" => 1, "Amarilla" => 0, "Penalti" => 0
        ),
        "Avila" => array(
            "Resultado" => "4-1", "Roja" => 0, "Amarilla" => 0, "Penalti" => 0
        ),
        "Valladolid" => array(
            "Resultado" => "1-2", "Roja" => 1, "Amarilla" => 1, "Penalti" => 1
        )
    ),
    "Salamanca" =>  array(
        "Zamora" => array(
            "Resultado" => "3-2", "Roja" => 1, "Amarilla" => 0, "Penalti" => 0
        ),
        "Avila" => array(
            "Resultado" => "4-1", "Roja" => 0, "Amarilla" => 0, "Penalti" => 0
        ),
        "Valladolid" => array(
            "Resultado" => "1-2", "Roja" => 1, "Amarilla" => 2, "Penalti" => 1
        )
    ),
    "Avila" =>  array(
        "Zamora" => array(
            "Resultado" => "3-2", "Roja" => 1, "Amarilla" => 0, "Penalti" => 2
        ),
        "Salamanca" => array(
            "Resultado" => "1-3", "Roja" => 1, "Amarilla" => 3, "Penalti" => 0
        ),
        "Valladolid" => array(
            "Resultado" => "1-3", "Roja" => 1, "Amarilla" => 0, "Penalti" => 1
        )
    ),
    "Valladolid" =>  array(
        "Zamora" => array(
            "Resultado" => "3-2", "Roja" => 1, "Amarilla" => 0, "Penalti" => 0
        ),
        "Salamanca" => array(
            "Resultado" => "3-1", "Roja" => 0, "Amarilla" => 0, "Penalti" => 0
        ),
        "Avila" => array(
            "Resultado" => "1-2", "Roja" => 1, "Amarilla" => 1, "Penalti" => 2
        )
    ),
);


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Resultados</title>
    <style>
        table {
            width: 100%;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Resultados de la Liga</h1>
    <table border="1">
        <tr>
            <th>Equipos</th>
            <?php
            // Mostrar encabezados de columnas con nombres de equipos
            foreach ($liga as $equipo => $resultados) {
                echo "<th>$equipo</th>";
            }
            ?>
        </tr>
        <?php
        // Mostrar los resultados de cada equipo y encabezados de las filas con nombres de los equipos
        foreach ($liga as $equipoLocal => $resultados) {
            echo "<tr><th>$equipoLocal</th>";

            //Este bucle nos sirve para commprobar si los dos equipos son el mismo
            foreach ($liga as $equipoVisitante => $partidos) {

                //si los equipos son diferentes se imprimen los datos del partido
                if ($equipoVisitante != $equipoLocal) {
                    foreach ($partidos as $partidoEquipo => $datos) {
                        if ($partidoEquipo == $equipoLocal) {
                            echo "<td>";
                            echo "Resultado: " . $datos["Resultado"] . "<br>";
                            echo "Rojas: " . $datos["Roja"] . "<br>";
                            echo "Amarillas: " . $datos["Amarilla"] . "<br>";
                            echo "Penaltis: " . $datos["Penalti"];
                            echo "</td>";
                            break;
                        }
                    }

                //si los equipos son el mismo (Zamora-Zamora) se imprime: -
                }else{
                    echo "<td>-</td>";
                }
            }

            echo "</tr>";
        }
        ?>
    </table>

    <br>
    <br>
    <br>

    <h1>Clasificacion en Liga</h1>

    
    <?php
    ?>



</body>
</html>
