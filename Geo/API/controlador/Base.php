<?php

class Base{
    // Método para enviar una respuesta HTTP al cliente
 public static function response($head, $body = ''){
    // Establecer el encabezado HTTP utilizando el valor proporcionado
    header($head);
    
    // Imprimir el cuerpo de la respuesta si se proporciona
    echo $body;
    
    // Detener la ejecución del script
    exit;
}

    // Método para dividir la URI en sus componentes
    public static function divideURI(){
        // Obtener la URI del servidor
        $uri = $_SERVER['PATH_INFO'];
        
        // Dividir la URI en sus componentes utilizando el carácter '/'
        return explode('/', $uri);
    }

    // Método para parsear las condiciones de la consulta de la URI
    public static function condiciones(){
        // Obtener la cadena de consulta de la URI actual
        parse_str($_SERVER['QUERY_STRING'], $filtros);
        
        // Devolver un array asociativo de condiciones
        return $filtros;
    }


}


?>