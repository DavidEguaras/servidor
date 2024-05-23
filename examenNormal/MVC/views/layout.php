<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aplicación de Coches</title>
    <link rel="stylesheet" href="<?php echo CSS; ?>style.css">
</head>
<body>
    <?php
        if (!isset($_SESSION['vista'])) {
            require VIEW.'login.php';
        } else {
            require $_SESSION['vista'];
        }
    ?>
</body>
</html>
