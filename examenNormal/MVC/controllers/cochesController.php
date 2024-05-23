<?php
if (isset($_REQUEST['ver_coches'])) {
    $_SESSION['vista'] = VIEW.'coches.php';
    $coches = get("coches");
    $coches = json_decode($coches, true);

    if (is_array($coches)) {
        $_SESSION['coches'] = $coches;
    } else {
        $_SESSION['coches'] = [];
    }
}

if (isset($_REQUEST['filtrar'])) {
    $filtros = "";
    if (!empty($_REQUEST['modelo'])) {
        $filtros .= "modelo=".$_REQUEST['modelo']."&";
    }
    if (!empty($_REQUEST['marca'])) {
        $filtros .= "marca=".$_REQUEST['marca']."&";
    }
    if (!empty($_REQUEST['descripcion'])) {
        $filtros .= "descripcion=".$_REQUEST['descripcion']."&";
    }
    $filtros = rtrim($filtros, "&");
    $coches = get("coches?".$filtros);
    $coches = json_decode($coches, true);

    if (is_array($coches)) {
        $_SESSION['coches'] = $coches;
    } else {
        $_SESSION['coches'] = [];
    }

    $_SESSION['vista'] = VIEW.'coches.php';
}

if (isset($_REQUEST['nuevo_coche'])) {
    $errores = array();
    if (validarFomInsertCoche($errores)) {
        $data = array(
            "marca" => $_REQUEST['marca'],
            "modelo" => $_REQUEST['modelo'],
            "descripcion" => $_REQUEST['descripcion'],
            "precio" => $_REQUEST['precio']
        );
        $response = post("coches", $data);
        $response = json_decode($response, true);

        if ($response) {
            $_SESSION['mensaje'] = "Coche añadido correctamente";
        } else {
            $errores['api'] = "Error al añadir el coche";
        }
    }

    $_SESSION['vista'] = VIEW.'coches.php';
    $coches = get("coches");
    $coches = json_decode($coches, true);

    if (is_array($coches)) {
        $_SESSION['coches'] = $coches;
    } else {
        $_SESSION['coches'] = [];
    }
}
?>
