<?
require('./config/confi.php');
session_start();



if(isset($_REQUEST['login']))
{
    require CON.'LoginController.php';
}
else if(!isset($_SESSION['usuario'])){
    $_SESSION['vista'] = VIEW .'login.php';
}
else if(isset($_REQUEST['Login_CerrarSesion'])){
    session_destroy();
    header('Location: ./index.php');
    exit;
}
else if(isset($_REQUEST['ir_home'])){
    $_SESSION['vista'] = VIEW.'home.php';
    $_SESSION['controlador'] = CON.'homeController.php';
    require $_SESSION['controlador'];
}else if(isset($_REQUEST['ver_usuario'])){
    $_SESSION['vista'] = VIEW.'perfilUser.php';
    $_SESSION['controlador'] = CON.'perfilController.php';
    require $_SESSION['controlador'];
}
else{
    require $_SESSION['controlador'];
}


require VIEW.'layout.php';




