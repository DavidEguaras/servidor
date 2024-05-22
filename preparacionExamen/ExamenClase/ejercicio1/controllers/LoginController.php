<?

if(isset($_REQUEST['Login_Registro'])){
    $_SESSION['vista'] = VIEW.'registro.php';
    $_SESSION['controlador'] = CON.'RegistroController.php';
    require $_SESSION['controlador'];
} 
elseif (isset($_REQUEST['Login_IniciarSesion'])){
    //ver si nombre y contraseña no estan vacios
    $errores = array();
    if(validaFormulario($errores)){
        //validado el usuario en la base de datos
        $usuario = UserDAO::validarUsuario($_REQUEST['email'],$_REQUEST['pass']);
        //iniciar sesion validada
        if($usuario != null){
            $_SESSION['user'] = $_REQUEST['email'];
            $_SESSION['token'] = $_REQUEST['pass'];

            $_SESSION['usuario'] = $usuario;
            $_SESSION['vista'] = VIEW.'home.php';
            $_SESSION['controlador'] = CON.'HomeController.php';
            require $_SESSION['controlador'];
            // unset($_SESSION['controller']);
        } else {
            $errores['validado'] = "No existe el usuario y contraseña";
        }
    }
} elseif (isset($_REQUEST['logOut'])) {
    session_destroy();
    header('Location: ./index.php');
    exit;
}