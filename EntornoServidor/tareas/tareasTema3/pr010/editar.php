<?php
if(isset($_POST['guardar'])){
    guardarCsv();    
}
if (isset($_REQUEST['alumno'])) {
    $alumno = $_REQUEST['alumno'];
    $archivo = "notas.csv";
    $contador = 0;
    if (($handle = fopen("notas.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";") ) !== FALSE ) {
        //lee el contenido del archivo csv
            if($contador == $alumno){
                $datos = $data;
                break;
            }
            $contador++;
        }
    }


    //Si el ususario pulsa volver, volvemos al fichero seleccionar.php
    if(isset($_POST['volver'])){
        header('Location: index.php?alumno=' . $_POST['alumno']);
        exit();
    }
    } else {
        echo "Error: No se proporcionó el nombre del archivo.";
    }
?>
<h1>editar</h1>
<!-- Formulario para modificar el contenido del archivo -->
<form action="" method="post">
    <label for="">nombre: </label><br>
    <br>
    <label for="">Nota 1 </label>
    <input type="number" value="<?php echo $datos[1]; ?>" name="nota1"><br>
    <br>
    <label for="">Nota 2 </label>
    <input type="number" value="<?php echo $datos[2]; ?>" name="nota2"><br>
    <br>
    <label for="">Nota 3 </label>
    <input type="number" value="<?php echo $datos[3]; ?>" name="nota3"><br>
    <br>

    <input type="submit" name="volver" value="Volver">
    <input type="submit" name="guardar" value="Guardar">
</form>