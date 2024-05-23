<?php

if (isset($_SESSION['token'])) {
    $coches = get("coches", $_SESSION['token']);
    $coches = json_decode($coches, true);

    if (isset($_REQUEST['filtrar'])) {
        $marca = $_REQUEST['marca'] ?? '';
        $modelo = $_REQUEST['modelo'] ?? '';
        $descripcion = $_REQUEST['descripcion'] ?? '';
        $filtros = "marca=$marca&modelo=$modelo&descripcion=$descripcion";
        $coches = get("coches?$filtros", $_SESSION['token']);
        $coches = json_decode($coches, true);
    }
} else {
    $_SESSION['vista'] = VIEW . 'login.php';
}

?>
