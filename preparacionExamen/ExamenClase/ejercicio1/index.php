<?

require './config/config.php';

//instanciar la sesion
session_start();

if(isset($_REQUEST['Login'])){
    $_SESSION['vista'] = VIEW .'login.php';
    $_SESSION['controlador'] = CON.'LoginController.php';
    require $_SESSION['controlador'];
}
elseif (isset($_SESSION['controlador'])) {
    require $_SESSION['controlador'];
}

require VIEW.'layout.php';
