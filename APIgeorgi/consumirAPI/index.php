<?php
    require('curl.php');
    require('configurarAPI.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de matriculas</title>
</head>
<body>
    <?php

        $matriculas = get("matricula/coche_id/1");
        $matriculas = json_decode($matriculas,true);

        if (!empty($matriculas)) { // Verificar si $matriculas no está vacío
            echo "<table border='1'><tr><th>ID</th><th>coche_id</th><th>Matricula</th></tr>";
            foreach ($matriculas as $matricula) {
                echo "<tr>";
                echo "<td>".$matricula['id']."</td>";
                echo "<td>".$matricula['coche_id']."</td>";
                echo "<td>".$matricula['matricula']."</td>";
                echo "<form method='post'><input type='hidden' name='id' id='id' value='".$matricula['id']."'>";
                echo "<td><input type='submit' name='borrar' id='borrar' value='Eliminar'></td>";
                echo "</form></tr>";
            }
            echo "</table>";
        } else {
            echo "No hay matriculas disponibles.";
        }

    

    ?>
</body>
</html>

