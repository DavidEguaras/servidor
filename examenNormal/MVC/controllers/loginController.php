<?php
if (isset($_REQUEST['login'])) {
    $errores = array();
    if (validarFormulario($errores)) {
        $nombreUser = $_REQUEST['nombre'];
        $passUser = $_REQUEST['pass'];
        $datosUser = get("usuarios?username=".$nombreUser."&password=".$passUser);
        $datosUser = json_decode($datosUser, true); // true para convertir en array

        if ($datosUser) {
            $_SESSION['usuario'] = $datosUser;
            $_SESSION['vista'] = VIEW.'home.php';
            $_SESSION['controlador'] = CON.'homeController.php';
            require $_SESSION['controlador'];   
        } else {
            $errores['login'] = "Usuario o contraseña incorrectos";
            $_SESSION['vista'] = VIEW.'login.php';
        }
    } else {
        $_SESSION['vista'] = VIEW.'login.php';
    }
} elseif (isset($_REQUEST['go_to_register'])) {
    $_SESSION['vista'] = VIEW.'register.php';
}
?>
