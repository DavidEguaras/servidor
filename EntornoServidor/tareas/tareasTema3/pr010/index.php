<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Si el usuario pulsa escribir le dirigimos a escribir.php
    if (isset($_POST['editar'])) {
        header('Location: editar.php?alumno=' . $_POST['alumno']);
        exit();
    }
}
?>

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

        $alumno = 0;
        if (($handle = fopen("notas.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

                foreach ($data as $cell) {
                    echo '<td>' . htmlspecialchars($cell) . '</td>';
                }

                //Boton1
                echo '<td>';
                echo '<form method="post" action="">'; 
                    echo '<button type="submit" value="editar" name="editar">Editar</button>';
                    echo '<input type="hidden" value="' . $alumno . '" name="alumno">';
                echo '</td>';

                //Boton 2
                echo '<td>';
                    echo '<button type="submit" value="Eliminar" name="eliminar">Eliminar</button>';
                echo '</form>';
                echo '</td>';

                echo '</tr>';
                $alumno++;
            }
            fclose($handle);
        }
        ?>
    </table>
</body>
</html>
