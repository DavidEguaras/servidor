<?php

require("./dao/UserDAO.php");

class UserController extends Base{

    public static function usuarios(){
        // Obtener el Metodo de la solicitud HTTP (GET, POST, PUT, DELETE)
        $Metodo = $_SERVER['REQUEST_METHOD'];
        
        // Obtener los recursos y filtros de la URI
        $recursos = self::divideURI();
        $filtros = self::condiciones();
        
        // switch para manejar diferentes Metodos HTTP
        switch ($Metodo) {
            case 'GET':
                if (count($recursos) == 2 && count($filtros)==2) {
                   if(isset($filtros['Nombre'])&&isset($filtros['Contraseña'])){
                       $datos = UserDAO::validarUser($filtros['Nombre'],$filtros['Contraseña']);
                    //    echo " **PRUEBA**<pre>";
                    //    echo"<br>*******************************************************<br>";
                    }
                }
                // Si no se cumplen las condiciones anteriores, devolver un error
                else {
                    self::response("HTTP/1.0 400 No está indicando los recursos necesarios");
                    break;
                }
                // Convertir los datos a formato JSON y enviar la respuesta
                $datos = json_encode($datos);
                self::response('HTTP/1.0 200 OK', $datos);
                break;
            
            
                case 'POST':
                    // Obtener los datos del cuerpo de la solicitud POST
                    $datos = file_get_contents('php://input');
                    $datos = json_decode($datos, true);
                    // Verificar si se han proporcionado los atributos necesarios
                    if (isset($datos['Nombre'], $datos['Contraseña'], $datos['Email'], $datos['FechaNacimiento'], $datos['IdRol'], $datos['Borrado'])) {
                        // Crear un objeto Usuario con los datos proporcionados
                        $usuario = new Usuario(
                            null, 
                            $datos['Nombre'], // Nombre del atributo corregido
                            sha1($datos['Contraseña']), // Nombre del atributo corregido
                            $datos['Email'], // Nombre del atributo corregido
                            $datos['FechaNacimiento'], // Nombre del atributo corregido
                            $datos['IdRol'], // Nombre del atributo corregido
                            $datos['Borrado'] // Nombre del atributo corregido
                        );
                        if( UserDAO::insert($usuario)){
                            self::response('HTTP/1.0 201 Usuario Creado Correctamente');
                        }
                        
                    }
                
                // Si no se proporcionan los atributos necesarios, devolver un error
                else{
                    self::response('HTTP/1.0 400 No esta introduciendo los atributos del usuario (nombre, contraseña, email
                    ,fecha de nacimiento y el id de rol');
                }
                break;
            case 'PUT':
            
                self::put();
                break;
    
            case 'DELETE':
                // Verificar si se está solicitando eliminar una matrícula por ID
                $recursos = self::divideURI();
                if(count($recursos) == 3){
                    // Verificar si la matrícula existe antes de intentar eliminarla
                    if(!empty(UserDAO::findbyId($recursos[2]))){
                        // Eliminar la matrícula de la base de datos
                        if(UserDAO::delete($recursos[2])){
                            self::response('HTTP/1.0 200 Recurso eliminado');
                        }else{
                            self::response('HTTP/1.0 400 No se pudo eliminar el recurso');
                        }
                    }else{
                        self::response('HTTP/1.0 400 No se pudo localizar el recurso a eliminar');
                    }
                }else{
                    self::response('HTTP/1.0 400 No ha indicado el id');
                }
                break;
    
            default:
                // Si se utiliza un Metodo no permitido, devolver un error
                self::response("HTTP/1.0 400 No permite el Metodo utilizado");
                break;
    }
}

static function put(){
    $recursos = self::divideURI();
    if(count($recursos) == 3){
        $permitimos = ['Nombre','Email'];
        $datos = file_get_contents('php://input');
        $datos = json_decode($datos,true);
        if($datos == null){
            self:: response('HTTP/1.0 400 El cuerpo no está bien formado'); 
        }
        // Verificar que lo recibido en el body son los usuarios
        foreach ($datos as $key => $value) {
            if(!in_array($key,$permitimos)){
                self::response("HTTP/1.0 400 No se permite la condicion utilizada: " .$key);
            }
        }
        $usuario = UserDAO::findbyId($recursos[2]);
        if(count($usuario) == 1){
            $usuario = (object)$usuario[0];
            foreach ($datos as $key => $value) {
                $usuario->$key = $value;
            }
            if(UserDAO::update($usuario)){
                $usuario = UserDAO::findbyId($recursos[2]);
                $usuario = json_encode($usuario);
                self::response('HTTP/1.0 201 Recurso modificado', $usuario);
            }else{
                self::response('HTTP/1.0 400 No esta introduciendo los atributos de usuario(nombre, localidad, telefono');
            }
        }else{
            self::response('HTTP/1.0 400 No se ha encontrado el usuario con ese ID');
        }
    }else{
        self::response('HTTP/1.0 400 No ha indicado el id');
    }
}

}

