

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <table>
        <?php
        echo '<tr>';
        echo '<th>Alumno</th>';
        echo '<th>Nota 1</th>';
        echo '<th>Nota 2</th>';
        echo '<th>Nota 3</th>';
        echo '<th>Modificar</th>';
        echo '<th>Eliminar</th>';
        echo '</tr>';

        $row = 1;
        if (($handle = fopen("notas.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                
                $data = array_filter($data, function($value) {
                    return !empty($value);
                });

                if (empty($data)) {
                    continue;
                }
                
                foreach ($data as $cell) {
                    echo '<td>' . htmlspecialchars($cell) . '</td>';
                }

                //Boton1
                echo '<td>';
                echo '<form method="post" action="">'; 
                    echo '<button type="submit" value="Modificar" name="modificar">Modificar</button>';
                echo '</form>';
                echo '</td>';

                //Boton 2
                echo '<td>';
                echo '<form method="post" action="">';
                    echo '<button type="submit" value="Eliminar"  name="eliminar">Eliminar</button>';
                echo '</form>';
                echo '</td>';

                echo '</tr>';
            }
            fclose($handle);
        }
        ?>
    </table>
</body>
</html>
