<?    
    require('curl.php');
    require('confApi.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Listar coches</h1>
    <?    
        $coches = get('coches');
        $coches = json_decode($coches, true);



    ?>

<table>
    <thead>
        <th>id</th>
        <th>marca</th>
        <th>modelo</th>
        <th>año_fabricacion</th>
        <th>kilometraje</th>
        <th>precio</th>
        <th>color</th>
        <th>descripcion</th>
    </thead>
    <tbody>
        <?

        print_r($coches);

        foreach ($coches as $c) {
            echo "<tr>";

                echo "<td>".$c['id']."</td>";
                echo "<td>".$c['marca']."</td>";
                echo "<td>".$c['modelo']."</td>";
                echo "<td>".$c['año_fabricacion']."</td>";
                echo "<td>".$c['kilometraje']."</td>";
                echo "<td>".$c['precio']."</td>";
                echo "<td>".$c['color']."</td>";
                echo "<td>".$c['descripcion']."</td>";

            echo "</tr>";
        }

        ?>
    </tbody>
</table>

</body>
</html>