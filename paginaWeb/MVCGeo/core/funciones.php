<?
function validarFormulario(&$errores)
{

    # code...
    if (isset($_REQUEST['nombre'])) {
        comNombre($errores);
    }
    if (isset($_REQUEST['pass'])) {
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

function validarFomInsertMatricula(&$errores){
    comMatricula($errores);
    if (count($errores) == 0) {
        return true;
    } else {
        return false;
    }
}

function validarFomInsertCoche(&$errores){
    if(isset($_REQUEST['marca'])){
        compMarca($errores);
    }
    if(isset($_REQUEST['modelo'])){
        compModelo($errores);
    }
    if(isset($_REQUEST['anio'])){
        compAnio($errores);
    }
    if(isset($_REQUEST['color'])){
        compColor($errores);
    }
    if(isset($_REQUEST['precio'])){
        compPrecio($errores);
    }
    if (count($errores) == 0) {
        return true;
    } else {
        return false;
    }
    

}

function validarInsert(&$errores){
    if(isset($_REQUEST['marca'])){
        compMarca($errores);
    }
    if(isset($_REQUEST['modelo'])){
        compModelo($errores);
    }
    if(isset($_REQUEST['anio'])){
        compAnio($errores);
    }
    if(isset($_REQUEST['color'])){
        compColor($errores);
    }
    if(isset($_REQUEST['precio'])){
        compPrecio($errores);
    }
    if (count($errores) == 0) {
        return true;
    } else {
        return false;
    }
    
}

function compMarca(&$errores){
    if(textoVacio('marca')){
        $errores['marca'] = "  Marca esta vacio";
        return false;
    }
    return true;
}
function compModelo(&$errores){
    if(textoVacio('modelo')){
        $errores['modelo'] = " Modelo esta vacio";
        return false;
    }
    return true;
}

function compAnio(&$errores){
    if(textoVacio('anio')){
        $errores['anio'] = " Año esta vacio";
        return false;
    }
    return true;
}

function compColor(&$errores){
    if(textoVacio('color')){
        $errores['color'] = " Color esta vacio";
        return false;
    }
    return true;
}

function compPrecio(&$errores){
    if(textoVacio('precio')){
        $errores['precio'] = " Precio esta vacio";
        return false;
    }
    return true;
}


function validarLetra(&$errores)
{
    if (textovacio('letraJuego')) {
        $errores['errorLetra'] = "El campo letraJuego está vacío.";
        return false;
    }
    return true;
}
function comMatricula(&$errores)
{
    if (empty($_REQUEST['matricula'])) {
        $errores['matricula'] = "Este campo está vacío";
    }
}
function comNombrer(&$errores)
{
    if (textoVacio('descUsuarior')) {
        $errores['descUsuarior'] = "este campo esta vacio";
    }
    // } elseif (!preg_match('/^[a-zA-Z]{3,}$/', $_REQUEST['nombre'])) {
    //     $errores['nombre'] = "combinacion incorrecta";
    // }
}
function comCodir(&$errores)
{

    if (textoVacio('codUsuarior')) {
        $errores['codUsuarior'] = "este campo esta vacio";
    }
    // } elseif (!preg_match('/^[a-zA-Z]{3,}$/', $_REQUEST['nombre'])) {
    //     $errores['nombre'] = "combinacion incorrecta";
    // }
}
function comcontrar(&$errores)
{
    if (textoVacio('passr')) {
        $errores['passr'] = "este campo esta vacio";
    }
    // } elseif (!preg_match('/^[a-zA-Z]{3,}$/', $_REQUEST['nombre'])) {
    //     $errores['nombre'] = "combinacion incorrecta";
    // }
}
function textovacio($name)
{
    if (empty($_REQUEST[$name])) {
        return true;
    }
    return false;
}
function comNombre(&$errores)
{
    if (textoVacio('nombre')) {
        $errores['nombre'] = "este campo esta vacio";
    }
    // } elseif (!preg_match('/^[a-zA-Z]{3,}$/', $_REQUEST['nombre'])) {
    //     $errores['nombre'] = "combinacion incorrecta";
    // }
}
function comcontra(&$errores)
{
    if (textoVacio('pass')) {
        $errores['pass'] = "este campo esta vacio";
    }
    // } elseif (!preg_match('/^\w{3,}\s+\w{3,}$/', $_REQUEST['apellido'])) {
    //     $errores['apellido'] = "combinacion incorrecta";
    // }
}


function escribirErrores($errores, $name)
{

    if (isset($errores[$name])) {
        echo '<span style="color: red;">' . $errores[$name] . '</span>';
    }
}
function validado()
{
    if (isset($_SESSION['usuario']))
        return true;
    else
        return false;
}
function admin()
{
    if ($_SESSION['usuario']->perfil === 'administrador') {
        return true;
    }
    return false;

}


function compararPalabras($letra, $PalabraAleatoria) {
    $letra = strtoupper($letra); 
    $PalabraAleatoria = strtoupper($PalabraAleatoria); 
    
    $arrayAleatoria = str_split($PalabraAleatoria);
    foreach ($arrayAleatoria as $key => $value) {
        if ($value === $letra) {
            return $value; 
        }
    }
    return "x"; 
}


// para borrar 
function eliminarMatricula($idMatricula,$idCoche) {
    // Eliminar la matrícula usando la API
    $result = deleteFromAPI("matricula", $idMatricula);

    if ($result) {
        // Actualizar la lista de matrículas después de eliminar
        $matriculas = get("matricula/coche_id/".$idCoche);
        $matriculas = json_decode($matriculas, true);
        $_SESSION['matriculas'] = $matriculas;
        $_SESSION['avisos'] = "Matrícula eliminada correctamente";
    } else {
        $_SESSION['errores']['eliminarMatricula'] = "No se ha podido eliminar la matrícula";
    }
}





