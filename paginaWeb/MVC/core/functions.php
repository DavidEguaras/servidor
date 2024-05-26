<?


function validarFormularioLogin(&$errors)
{

    # code...
    if (isset($_REQUEST['username'])) {
        comNombreLogin($errors);
    }
    if (isset($_REQUEST['password'])) {
        comContraLogin($errors);
    }
    if (count($errors) == 0) {
        return true;
    } else
        return false;

}

function validarFormulario(&$errores)
{

    # code...
    if (isset($_REQUEST['usernameRegister'])) {
        comNombre($errores);
    }
    if (isset($_REQUEST['passwordRegister'])) {
        comcontra($errores);
    }
    // if (isset($_REQUEST['codUsuarior'])) {
    //     comCodir($errores);
    // }
    // if (isset($_REQUEST['descUsuarior'])) {
    //     comNombrer($errores);
    // }
    // if (isset($_REQUEST['passr'])) {
    //     comcontrar($errores);
    // }

    if (count($errores) == 0) {
        return true;
    } else
        return false;

}

// Función para validar el formulario de registro
function validarFormularioRegistro(&$errors) {
    $valid = true;

    // Validar el nombre de usuario
    if (empty($_REQUEST['username'])) {
        $errors['username'] = "El nombre de usuario es obligatorio.";
        $valid = false;
    }

    // Validar el nombre completo
    if (empty($_REQUEST['name'])) {
        $errors['name'] = "El nombre completo es obligatorio.";
        $valid = false;
    }

    // Validar el correo electrónico
    if (empty($_REQUEST['email'])) {
        $errors['email'] = "El correo electrónico es obligatorio.";
        $valid = false;
    } elseif (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "El correo electrónico no es válido.";
        $valid = false;
    }

    // Validar la contraseña
    if (empty($_REQUEST['password'])) {
        $errors['password'] = "La contraseña es obligatoria.";
        $valid = false;
    }

    return $valid;
}

function validarInsert(&$errors){
    if(isset($_REQUEST['marca'])){
        compMarca($errors);
    }
    if(isset($_REQUEST['modelo'])){
        compModelo($errors);
    }
    if(isset($_REQUEST['anio'])){
        compAnio($errors);
    }
    if(isset($_REQUEST['color'])){
        compColor($errors);
    }
    if(isset($_REQUEST['precio'])){
        compPrecio($errors);
    }
    if (count($errors) == 0) {
        return true;
    } else {
        return false;
    }
    
}



function validarLetra(&$errors)
{
    if (textovacio('letraJuego')) {
        $errors['errorLetra'] = "El campo letraJuego está vacío.";
        return false;
    }
    return true;
}
function comMatricula(&$errors)
{
    if (empty($_REQUEST['matricula'])) {
        $errors['matricula'] = "Este campo está vacío";
    }
}
function comNombrer(&$errors)
{
    if (textoVacio('descuserr')) {
        $errors['descuserr'] = "este campo esta vacio";
    }
    // } elseif (!preg_match('/^[a-zA-Z]{3,}$/', $_REQUEST['nombre'])) {
    //     $errors['nombre'] = "combinacion incorrecta";
    // }
}
function comCodir(&$errors)
{

    if (textoVacio('coduserr')) {
        $errors['coduserr'] = "este campo esta vacio";
    }
    // } elseif (!preg_match('/^[a-zA-Z]{3,}$/', $_REQUEST['nombre'])) {
    //     $errors['nombre'] = "combinacion incorrecta";
    // }
}
function comcontrar(&$errors)
{
    if (textoVacio('passr')) {
        $errors['passr'] = "este campo esta vacio";
    }
    // } elseif (!preg_match('/^[a-zA-Z]{3,}$/', $_REQUEST['nombre'])) {
    //     $errors['nombre'] = "combinacion incorrecta";
    // }
}
function textovacio($name)
{
    if (empty($_REQUEST[$name])) {
        return true;
    }
    return false;
}
function comNombreRegister(&$errors)
{
    if (textoVacio('usernameRegister')) {
        $errors['usernameRegister'] = "este campo esta vacio";
    }
    // } elseif (!preg_match('/^[a-zA-Z]{3,}$/', $_REQUEST['nombre'])) {
    //     $errors['nombre'] = "combinacion incorrecta";
    // }
}
function comcontraRegister(&$errors)
{
    if (textoVacio('passwordRegister')) {
        $errors['passwordRegister'] = "este campo esta vacio";
    }
    // } elseif (!preg_match('/^\w{3,}\s+\w{3,}$/', $_REQUEST['apellido'])) {
    //     $errors['apellido'] = "combinacion incorrecta";
    // }
}

function comNombreLogin(&$errors)
{
    if (textoVacio('username')) {
        $errors['username'] = "este campo esta vacio";
    }
    // } elseif (!preg_match('/^[a-zA-Z]{3,}$/', $_REQUEST['nombre'])) {
    //     $errors['nombre'] = "combinacion incorrecta";
    // }
}

function comContraLogin(&$errors)
{
    if (textoVacio('password')) {
        $errors['password'] = "este campo esta vacio";
    }
    // } elseif (!preg_match('/^\w{3,}\s+\w{3,}$/', $_REQUEST['apellido'])) {
    //     $errors['apellido'] = "combinacion incorrecta";
    // }
}



function writeErrors($errors, $name)
{

    if (isset($errors[$name])) {
        echo '<span style="color: red;">' . $errors[$name] . '</span>';
    }
}
function validated()
{
    if (isset($_SESSION['user']))
        return true;
    else
        return false;
}
function admin()
{
    if ($_SESSION['user']->perfil === 'administrador') {
        return true;
    }
    return false;

}