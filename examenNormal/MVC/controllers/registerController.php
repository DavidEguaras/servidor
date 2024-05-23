<?php
if (isset($_REQUEST['register'])) {
    $errores = array();
    if (validarFormulario($errores)) {
        // Cerrar sesión actual
        session_unset();
        session_destroy();
        session_start(); // Iniciar una nueva sesión

        $data = array(
            "username" => $_REQUEST['nombre'],
            "name" => $_REQUEST['nombre_completo'],
            "rol" => 'user', // Default role is 'user'
            "password" => $_REQUEST['pass'],
            "email" => $_REQUEST['email']
        );

        $response = post("usuarios", $data);
        $response = json_decode($response, true);

        if ($response) {
            $_SESSION['mensaje'] = "Usuario registrado correctamente";
            $_SESSION['usuario'] = $response; // Guardar los datos del usuario en la sesión
            $_SESSION['vista'] = VIEW.'coches.php';
            $_SESSION['controlador'] = CON.'cochesController.php';
            require $_SESSION['controlador'];
        } else {
            $errores['api'] = "Error al registrar el usuario";
            $_SESSION['vista'] = VIEW.'register.php';
        }
    } else {
        $_SESSION['vista'] = VIEW.'register.php';
    }
}
?>
