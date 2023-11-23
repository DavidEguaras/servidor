

<?php

//-strlen($nombre): Esta función se utiliza para obtener la longitud (cantidad de caracteres) de una cadena, en este caso, se verifica la longitud del campo "nombre".

//-empty($nombre): La función empty se utiliza para comprobar si una variable o campo está vacío. Se verifica si el campo "nombre" está vacío.

//-explode(" ", $apellidos): La función explode se usa para dividir una cadena en partes utilizando un delimitador específico. 
    //En este caso, divide el campo "apellidos" en partes separadas por un espacio en blanco.

// -count($apellidosArray): La función count se utiliza para contar el número de elementos en un array. 
    //En este caso, se cuenta el número de elementos en el array resultante de la operación explode en el campo "apellidos".

//-preg_match(): Esta función se utiliza para realizar una búsqueda de expresiones regulares. Se utiliza para validar la contraseña en función de una expresión regular.

//-$contrasena !== $repetirContrasena: Se utiliza para comparar si los campos de contraseña y repetir contraseña no son iguales.

//-strtotime($fechaNacimiento): La función strtotime se utiliza para convertir una cadena de fecha en una marca de tiempo Unix.

//-filter_var($correo, FILTER_VALIDATE_EMAIL): Se utiliza para validar si la cadena en la variable "correo" es una dirección de correo electrónico válida.

//-echo: La función echo se utiliza para mostrar mensajes o contenido en la salida del script.


    //Declaramos un array de errores para almecenar los errores de las validaciones



    function validarDNI ($dni){
        //definir patron para el dni

    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $contrasena = $_POST["contrasena"];
        $repetirContrasena = $_POST["repetir_constrasena"];
        $fecha = $_POST["fecha"];
        $dni = $_POST["dni"];
        $correo = $_POST["correo"];


        //validar nombre
        if(empty($nombre) || strlen($nombre)){
            $errores[] = "El nombre no puede estar vacio y debe tener mas de 3 caracteres"; 
        }


        //validar apellidos
        if(){

        }


        //validar contrasena
        if(){

        }


        //comparar contrasena
        if(){

        }


        //validar fecha
        if(){

        }


        //validar dni
        if(){

        }


        //calidar correo
        if(){

        }

        //Comprobamos si hay algun error
        if(empty($errores)){
            echo '<pre>'; print_r($errores); echo '</pre>';
        }else{
            echo "Datos validados con exito: <br>";
            echo "<br> Nombre: " . $nombre;
            echo "<br> Apellidos: " . $apellidos;
            echo "<br> Fecha de Nacimiento" . $fecha;
            echo "<br> DNI: " . $dni;
            echo "<br> Email: " . $correo;
        }


    }
?>
