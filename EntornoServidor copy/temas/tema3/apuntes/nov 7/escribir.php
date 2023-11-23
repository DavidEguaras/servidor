<?php
if (isset($_REQUEST['fichero'])) {
    $file = $_REQUEST['fichero'];
    if (isset($_POST['guardar'])) {
        //comprobamos si el usuario ha agregado contenido al fichero
        if (isset($_POST['contenido'])) {
            //guardamos el contenido en una variable
            $contenido = $_POST['contenido'];
            //comprobamos si el fichero se ha podido modificar correctamente
            if (file_put_contents($file, $contenido) !== false) {
                echo 'Contenido guardado exitosamente.';
            } else {
                echo 'Error al guardar el contenido en el archivo.';
            }
        } else {
            echo 'Error: No se proporcionó contenido para guardar.';
        }
    }
    //Si el ususario pulsa volver, volvemos al fichero seleccionar.php
    if(isset($_POST['volver'])){
        header('Location: seleccionar.php?fichero=' . $_POST['file']);
        exit();
    }
} else {
    echo "Error: No se proporcionó el nombre del archivo.";
}
?>
<!-- Formulario para modificar el contenido del archivo -->
<form action="" method="post">
    <textarea name="contenido" cols="30" rows="10"><?php if (isset($file)) echo file_get_contents($file); ?></textarea><br>
    <input type="submit" value="Guardar" name="guardar">
    <input type="submit" value="Volver" name="volver">
    <input type="hidden" value="<?php if (isset($file)) echo ($file);?>" name="fichero">
</form>