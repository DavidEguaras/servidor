<?php

require('./config/config.php');
session_start();

if (isset($_REQUEST['login'])) {
    require CON . 'loginController.php';
} elseif (isset($_REQUEST['register'])) {
    require CON . 'registerController.php';
} elseif (isset($_REQUEST['logOut'])) {
    session_destroy();
    header('Location: ./index.php');
    exit;
} elseif (isset($_REQUEST['registerForm'])) {
    $_SESSION['vista'] = VIEW . 'register.php';
} elseif (isset($_SESSION['usuario'])) {
    if (!isset($_SESSION['vista'])) {
        $_SESSION['vista'] = VIEW . 'home.php';
        $_SESSION['controlador'] = CON . 'homeController.php';
    }
    require $_SESSION['controlador'];
} else {
    $_SESSION['vista'] = VIEW . 'login.php';
}

require $_SESSION['vista'];

?>
