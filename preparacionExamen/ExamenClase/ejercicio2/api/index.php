<?

require('./controlador/Base.php');
require('./controlador/CocheController.php');


if (isset($_SERVER['PATH_INFO'])) {
    //comprobar el recurso
    $recurso = Base::divideURI();
    // echo $recurso[1];
    if ($recurso[1] === 'coches'){
        CocheController::coches();
    } else {

    }
} else {
    Base::response("HTTP/1.0 400 Dirección incorrecta, no se ha especificado el recurso");
}