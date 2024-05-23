<?php
$partidos = get("partido");
$partidos = json_decode($partidos, true);



if (is_array($partidos)) {
    $_SESSION['partidos'] = $partidos;
} else {
    $_SESSION['partidos'] = [];
}




if (isset($_REQUEST['nuevo_partido'])) {
    $data = array(
        "jug1" => $_REQUEST['jug1'],
        "jug2" => $_REQUEST['jug2'],
        "fecha" => $_REQUEST['fecha'],
        "resultado" => $_REQUEST['resultado']
    );
    $response = post("partido", $data);
    $response = json_decode($response, true);

    if ($response) {
        $_SESSION['mensaje'] = "Partido añadido correctamente";
    }
}
?>
