<?php

require("./dao/CategoriaDAO.php");

class   CategoriaController extends Base{

    public static function categoria(){
        // Obtener el método de la solicitud HTTP (GET, POST, PUT, DELETE)
        $metodo = $_SERVER['REQUEST_METHOD'];
        // Obtener los recursos y filtros de la URI
        $recursos = self::divideURI();
        $filtros = self::condiciones();
        // switch para manejar diferentes métodos HTTP
        switch ($metodo) {
            case 'GET':
                //para todas las categorias
                if (count($recursos) == 2 && count($filtros)==0) {
                       $datos = CategoriaDAO::findAll();
                }
                //para buscar categoria por nombre
                elseif (count($recursos) == 2 && count($filtros)==1) {
                    if(isset($filtros['Nombre'])){
                        $datos=CategoriaDAO::findByNombre($filtros['Nombre']);
                    }
                }
                elseif (count($recursos) == 3 && count($filtros)==0) {
                    
                    $datos=CategoriaDAO::findById($recursos[2]);
                }
                
                // Si no se cumplen las condiciones anteriores, devolver un error
                else {
                    self::response("HTTP/1.0 400 No está indicando lo['Nombre']s recursos necesarios");
                    break;
                }
                // Convertir los datos a formato JSON y enviar la respuesta
                $datos = json_encode($datos);
                self::response('HTTP/1.0 200 OK', $datos);
                break;
            
            
            case 'POST':
                // Obtener los datos del cuerpo de la solicitud POST
                $datos = file_get_contents('php://input');
                $datos = json_decode($datos,true);
                // Verificar si se han proporcionado los atributos necesarios 
                if (isset($datos['Nombre'], $datos['Borrado'])) {
          
                    $categoria = new Categoria(
                        null, 
                        $datos['Nombre'], // Nombre del atributo corregido
                        $datos['Borrado'] // Nombre del atributo corregido
                    );
                    if( CategoriaDAO::insert($categoria)){
                        self::response('HTTP/1.0 201 Categoria Creada Correctamente');
                    }
                    
                }
            
            // Si no se proporcionan los atributos necesarios, devolver un error
            else{
                self::response('HTTP/1.0 400 No esta introduciendo los atributos necesarios (nombre');
            }
                break;
    
                case 'DELETE':
                    // Verificar si se está solicitando eliminar un producto por ID
                    if (count($recursos) == 3) {
                        $idProducto = $recursos[2];
                        // Verificar si el producto existe antes de intentar eliminarlo
                        if (!empty(CategoriaDAO::findById($idProducto))) {
                            // Eliminar el producto de la base de datos
                            if (CategoriaDAO::delete($idProducto)) {
                                self::response('HTTP/1.0 200 Recurso eliminado');
                            } else {
                                self::response('HTTP/1.0 500 No se pudo eliminar el recurso');
                            }
                        } else {
                            self::response('HTTP/1.0 404 No se pudo localizar el recurso a eliminar');
                        }
                    } else {
                        self::response('HTTP/1.0 400 No ha indicado el ID');
                    }
                    break;
    
                default:
                    // Si se utiliza un método no permitido, devolver un error
                    self::response("HTTP/1.0 405 Método no permitido");
                    break;
            }
}






    
}