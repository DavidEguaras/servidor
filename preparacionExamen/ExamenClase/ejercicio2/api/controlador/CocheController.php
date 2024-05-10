<?

require ('./dao/CocheDAO.php');

class CocheController extends Base{
    public static function coches(){
        $metodo = $_SERVER['REQUEST_METHOD'];
        $recursos = self::divideURI();
        $filtros = self::condiciones();
        switch ($metodo) {
            case 'GET':
                if(count($recursos)==2 && count($filtros) == 0){ //si tiene dos, sabemos que no tiene nada detras
                    $datos = CocheDAO::findAllCoches();
                } else if(count($recursos)==2 && count($filtros) == 1) {
                    $datos = self::filtrarCoches();
                } else {
                    self::response("HTTP/1.0 400 No está indicando los recursos necesarios");
                }
                $datos = json_encode($datos);
                self::response('HTTP/1.0 200 OK', $datos);
                break;

            default:
                self::response("HTTP/1.0 400 No permite el método utilizado");
                break;
        }
    }

    public static function filtrarCoches(){
        //comprobar si el nombre del filtro está permitido
        $permitidos = ['marca', 'modelo', 'descripcion'];
        $filtros = self::condiciones();
        foreach ($filtros as $key => $value) {
            if(!in_array($key, $permitidos)){
                self::response("HTTP/1.0 400 No permite usar el parámetro: ".$key);
            }
        }
        return CocheDAO::filtrarCoches($filtros);
    }
}