<?php
require('./config/config.php');
session_start();

if (isset($_REQUEST['login'])) {
    require CON . 'loginController.php';
} elseif (isset($_REQUEST['register'])) {
    $_SESSION['controller'] = CON . 'registerController.php';
    $_SESSION['view'] = VIEW . 'register.php';
    require $_SESSION['controller'];
} elseif (isset($_REQUEST['registerSubmit'])) {
    require CON . 'registerController.php';
} elseif (!isset($_SESSION['user'])) {
    $_SESSION['view'] = VIEW . 'login.php';
} elseif (isset($_REQUEST['logOut'])) {
    session_destroy();
    header('Location: ./index.php');
    exit;
} elseif (isset($_REQUEST['goHome'])) {
    $_SESSION['view'] = VIEW . 'home.php';
    $_SESSION['controller'] = CON . 'homeController.php';
    require $_SESSION['controller'];
} else {
    if (isset($_SESSION['controller'])) {
        require $_SESSION['controller'];
    }
}

require VIEW . 'layout.php';
?>


