<?php



if(isset($_REQUEST['login'])){
    $errores = array();
    if(validarFormularioLogin($errores)){
        $nombreUser=$_REQUEST['nombre'];
        $passUser=$_REQUEST['pass'];
        //user?username=jdoe&password=password123
        $datosUser = get("user?username=".$nombreUser."&password=".$passUser);
        $datosUser = json_decode($datosUser,true); //true para convertir en array
        $usuario=$datosUser;

        // if(!$usuario){
        //     echo "usuario validado";
        // }
        if(isset($_REQUEST['recordar'])){
            setcookie('username', $_REQUEST['nombre'], time() + 60*60*24*365); // 1 año
        }else{
            setcookie('username', $_REQUEST['nombre'], time() - 3600 );
        }

        if($usuario){
            $_SESSION['usuario'] = $usuario;
            $_SESSION['vista'] = VIEW.'home.php';
            $_SESSION['controlador'] = CON.'homeController.php';
            require $_SESSION['controlador'];
        }else{
            //Declarar errors
        }
    }

}