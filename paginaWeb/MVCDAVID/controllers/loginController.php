<?php

if(isset($_REQUEST['login'])){
    $errores = array();
    if(validarFormulario($errores)){
        $nombreUser=$_REQUEST['nombre'];
        $passUser=$_REQUEST['pass'];
        $datosUser = get("usuarios?Nombre=".$nombreUser."&Contraseña=".$passUser);
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
            //comprobar carrito
            $datosCarritoUser=$datosProducto=get("carrito?".$usuario->Id);
            $datosCarritoUser=json_decode($datosCarritoUser);
            if($datosCarritoUser){
                $_SESSION['carrito']=$datosCarritoUser;
            }
        }   
    }
}