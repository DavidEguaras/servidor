<?php

if (isset($_REQUEST['login'])) {
    $errors = array();
    
    if (validarFormularioLogin($errors)) {
        if (isset($_REQUEST['username']) && isset($_REQUEST['pass'])) {
            $username = $_REQUEST['username'];
            $password = $_REQUEST['pass'];
            
            // Llamada a la API o base de datos para obtener los datos del usuario
            $userData = get("user?username=" . $username . "&password=" . $password);
            $userData = json_decode($userData, true); // true para convertir en array
            $user = $userData;
            
            // Manejo de la cookie para recordar al usuario
            if (isset($_REQUEST['rememberUser'])) {
                setcookie('username', $_REQUEST['username'], time() + 60*60*24*365); // 1 año
            } else {
                setcookie('username', $_REQUEST['username'], time() - 3600);
            }
            
            // Si se ha introducido un usuario correctamente, lo llevamos a la pagina de home   
            if ($user) {
                $_SESSION['user'] = $user;
                //hacemos que en la session se guarde un array con los carros(objeto) del user
                $_SESSION['userCarts'] = get("cart?USER_ID=" . $_SESSION['user']['USER_ID']);
                $_SESSION['view'] = VIEW . 'home.php';
                $_SESSION['controller'] = CON . 'homeController.php';
                require $_SESSION['controller'];
            } else {
                $errors[] = "Invalid username or password.";
            }
        } else {
            $errors[] = "Username or password not set.";
        }
    }
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}



