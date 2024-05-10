<?

if(isset($_REQUEST['Login_IniciarSesion'])){
    $_SESSION['vista'] = VIEW.'login.php';
    $_SESSION['controlador'] = CON.'LoginController.php';
    require $_SESSION['controlador'];
}