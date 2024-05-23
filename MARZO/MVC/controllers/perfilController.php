<?

     //print_r($_SESSION['usuario']);

    if (isset($_REQUEST['user_cambios'])) {
        // Verificar si 'nuevo_nombre' está vacío, si es así, usar el nombre actual de la sesión
        if (empty($_REQUEST['nuevo_nombre'])) {
            $_REQUEST['nuevo_nombre'] = $_SESSION['usuario']['Nombre'];
        }
    
        // Verificar si 'nuevo_email' está vacío, si es así, usar el email actual de la sesión
        if (empty($_REQUEST['nuevo_email'])) {
            $_REQUEST['nuevo_email'] = $_SESSION['usuario']['Email'];
        }
    
   
  

        $datos_actualizados = array(
            "Nombre" =>  $_REQUEST['nuevo_nombre'],
            "Email" =>  $_REQUEST['nuevo_email']
        );

       if( $updateUser = put("usuarios", $_SESSION['usuario']['Id'], $datos_actualizados)){
        $_SESSION['vista'] = VIEW.'home.php';
        $_SESSION['controlador'] = CON.'homeController.php';
        require $_SESSION['controlador'];
        $datosUser = get("usuarios?Nombre=".$_SESSION['usuario']['Nombre']."&Contraseña=".$_SESSION['usuario']['Contraseña']);
        $_SESSION['usuario'] = json_decode($datosUser,true); //true para convertir en array
       }
    }
    
?>