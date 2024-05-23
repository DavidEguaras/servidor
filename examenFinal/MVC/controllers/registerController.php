<?php

if (isset($_REQUEST['register'])) {
    $errores = array();
    if (validarFormularioRegister($errores)) {
        $nombreUser = $_REQUEST['nombre'];
        $token = generarToken();
        $caduca = fechaCaducidad();
        $data = array(
            'user' => $nombreUser,
            'token' => $token,
            'caduca' => $caduca
        );
        $response = post("user", $data);
        $response = json_decode($response, true);

        if ($response) {
            $_SESSION['token'] = $token;
            $_SESSION['vista'] = VIEW . 'token.php';
        } else {
            $errores[] = "Error al registrar el usuario.";
        }
    } else {
        $errores[] = "Formulario no válido.";
    }
}

?>
