<?php

if (isset($_REQUEST['login'])) {
    $errores = array();
    if (validarFormularioLogin($errores)) {
        $nombreUser = $_REQUEST['nombre'];
        $passUser = $_REQUEST['pass'];
        $datosUser = get("user?username=" . $nombreUser . "&password=" . $passUser);
        $datosUser = json_decode($datosUser, true);

        if ($datosUser && strtotime($datosUser['caduca']) > time()) {
            $_SESSION['usuario'] = $datosUser;
            $_SESSION['token'] = $datosUser['token'];
            $_SESSION['vista'] = VIEW . 'home.php';
            $_SESSION['controlador'] = CON . 'homeController.php';
            require $_SESSION['controlador'];
        } else {
            $errores[] = "Usuario o contraseña incorrectos, o el token ha caducado.";
        }
    }
}

?>
