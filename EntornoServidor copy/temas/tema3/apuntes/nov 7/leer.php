<?php
// Verifica si se proporcionó el parámetro 'fichero' en la URL
if (isset($_GET['fichero'])) {
    $file = $_GET['fichero'];

    // Comprueba si el archivo existe
    if (file_exists($file)) {
        // Lee y muestra el contenido del archivo
        $contenido = file_get_contents($file);
        echo "<h1>Contenido de $file</h1>";
        echo "<pre>$contenido</pre>";
    } else {
        echo "Error: El archivo no existe.";
    }
    //Si el ususario pulsa volver, volvemos al fichero seleccionar.php
    if(isset($_POST['volver'])){
        header('Location: seleccionar.php?fichero=' . $file);
        exit();
    }
    //Si el usuario pulsa escribir le dirigimos a escribir.php
    if (isset($_POST['escribir'])) {
        header('Location: escribir.php?fichero=' . $file);
        exit();
        
    } 
} else {
    echo "Error: No se proporcionó el nombre del archivo.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="submit" value="Escribir" name="escribir">
        <input type="submit" value="Volver" name="volver">
    </form>
</body>
</html>