<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Si el usuario pulsa escribir le dirigimos a escribir.php
    if (isset($_POST['escribir'])) {
        header('Location: escribir.php?fichero=' . $_POST['file']);
        exit();
    } elseif (isset($_POST['leer'])) {
        $file = $_POST['file'];
        if(file_exists($file)) {
            header('Location: leer.php?fichero=' .  $_POST['file']);
            exit();
        } else {
            echo "Error: No se a proporcianado el nombre de un archivo o este no existe";
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