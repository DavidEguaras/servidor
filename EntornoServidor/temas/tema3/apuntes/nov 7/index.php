<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['escribir'])) {
        // El usuario eligió escribir, redirige a escribir.php
        header('Location: escribir.php');
        exit();
        
    } elseif (isset($_POST['leer'])) {
        $file = $_POST['file'];
        // Comprueba si el archivo existe
        if (file_exists($file)) {
            // Redirige a leer.php con el nombre del archivo como parámetro
            header('Location: leer.php?fichero=' . $file);
            exit();
        } else {
            echo "Error: El archivo no existe.";
        }
    }
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
        <input type="text" name="file">
        <input type="submit" value="Escribir" name="escribir">
        <input type="submit" value="Leer" name="leer">
    </form>
</body>
</html>