<?
    if(time() > $caduca) {
        echo "caducado";
?>
<p>Ha caducado su token</p>
<?
    } else {
        echo "no caducado";
?>

<br>
<form action="" method="post">
    <input type="text" name="filtrar_coches" id="filtrar_coches">
    <input type="submit" value="Filtrar" name="Home_FiltrarCoches">
</form>

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
        if (isset($_SESSION['coches'])) {
            foreach ($_SESSION['coches'] as $key => $value) {
                echo "<tr>";
                echo "<td>". $_SESSION['coches'][$key]->id ."</td>";
                echo "<td>". $_SESSION['coches'][$key]->marca ."</td>";
                echo "<td>". $_SESSION['coches'][$key]->modelo ."</td>";
                echo "<td>". $_SESSION['coches'][$key]->año_fabricacion ."</td>";
                echo "<td>". $_SESSION['coches'][$key]->kilometraje ."</td>";
                echo "<td>". $_SESSION['coches'][$key]->precio ."</td>";
                echo "<td>". $_SESSION['coches'][$key]->color ."</td>";
                echo "<td>". $_SESSION['coches'][$key]->descripcion ."</td>";
                echo "</tr>";
            }
        } else {
            exit('Error');
        }
        ?>
    </tbody>
</table>

<?
    }
?>

<br>

<form action="" method="post">
    <input type="submit" value="Logout" name="Home_CerrarSesion">
</form>