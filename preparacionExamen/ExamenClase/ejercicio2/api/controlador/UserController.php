<?php

require('./dao/UserDAO.php');

class UserController extends Base {
    public static function users() {
        $metodo = $_SERVER['REQUEST_METHOD'];
        $recursos = self::divideURI();
        $filtros = self::condiciones();

        switch ($metodo) {
            case 'GET':
                if (count($recursos) == 2 && count($filtros) == 0) {
                    $datos = UserDAO::getAllUsers();
                } else if (count($recursos) == 2 && count($filtros) == 1) {
                    $filtro = $filtros[0];
                    $datos = UserDAO::getUserByFilter($filtro);
                } else {
                    self::response("HTTP/1.0 400 No está indicando los recursos necesarios");
                    return;
                }
                $datos = json_encode($datos);
                self::response('HTTP/1.0 200 OK', $datos);
                break;

            case 'POST':
                $datos = file_get_contents('php://input');
                $datos = json_decode($datos, true);

                if (isset($datos['nombre']) && isset($datos['localidad']) && isset($datos['telefono'])) {
                    $user = new User(
                        null, $datos['nombre'], $datos['localidad'], $datos['telefono']
                    );
                    if (UserDAO::insert($user)) {
                        $user = UserDAO::findLast();
                        $user = json_encode($user);
                        self::response("HTTP/1.0 201 Insertado correctamente", $user);
                    } else {
                        self::response("HTTP/1.0 500 Error al insertar el usuario");
                    }
                } else {
                    self::response("HTTP/1.0 400 Falta información del usuario");
                }
                break;

            default:
                self::response("HTTP/1.0 400 No permite el método utilizado");
                break;
        }
    }
}

?>
