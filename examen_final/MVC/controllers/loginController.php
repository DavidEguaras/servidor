<?php
if (isset($_REQUEST['login'])) {
    $errores = array();

    $user = $_REQUEST['nombre'];
    $password = $_REQUEST['pass'];
    $datosUser = UsuariosDAO::login($user, $password);


    if ($datosUser) {
        $_SESSION['usuario'] = $datosUser;
        $_SESSION['vista'] = VIEW.'partidos.php';
        $_SESSION['controlador'] = CON.'partidosController.php';
        require $_SESSION['controlador'];   
    } else {
        $errores['login'] = "Usuario o contraseña incorrectos";
        $_SESSION['vista'] = VIEW.'login.php';
    }
    }
?>
