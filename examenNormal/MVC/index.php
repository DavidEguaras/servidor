<?php
require('./config/config.php');
session_start();

if (isset($_REQUEST['login'])) {
    require CON.'loginController.php';
} elseif (isset($_REQUEST['go_to_register'])) {
    $_SESSION['vista'] = VIEW.'register.php';
} elseif (isset($_REQUEST['register'])) {
    require CON.'registerController.php';
} else if (!isset($_SESSION['usuario'])) {
    $_SESSION['vista'] = VIEW.'login.php';
} else if (isset($_REQUEST['logOut'])) {
    session_destroy();
    header('Location: ./index.php');
    exit;
} else if (isset($_REQUEST['ir_home'])) {
    $_SESSION['vista'] = VIEW.'home.php';
    $_SESSION['controlador'] = CON.'homeController.php';
    require $_SESSION['controlador'];
} else if (isset($_REQUEST['ver_coches']) || isset($_REQUEST['filtrar']) || isset($_REQUEST['nuevo_coche'])) {
    require CON.'cochesController.php';
} else {
    require $_SESSION['controlador'];
}

require VIEW.'layout.php';
?>
