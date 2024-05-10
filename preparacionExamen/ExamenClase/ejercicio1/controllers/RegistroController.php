<?

if(isset($_REQUEST['Registro_Registrar'])){
    // $email = $_REQUEST['email'];
    //ver si email no esta vacio
    $errores = array();
    if(validaRegistro($errores)){
        //generar token
        $token = generarToken(32);
        $_SESSION['token'] = $token;
        $_SESSION['user'] = $_REQUEST['email'];
        //crear usuario
        $usuario = UserDAO::crearUsuario($_REQUEST['email'],$token);
        //mostrar token
        $_SESSION['vista'] = VIEW.'token.php';
        $_SESSION['controlador'] = CON.'TokenController.php';
        require $_SESSION['controlador'];

    } else {
        $errores['validado'] = "No existe el usuario y contraseña";
    }

} 
elseif (isset($_REQUEST['Registro_volver'])) {
    $_SESSION['vista'] = VIEW .'login.php';
    $_SESSION['controlador'] = CON.'LoginController.php';
    require $_SESSION['controlador'];
}