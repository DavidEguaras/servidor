
<?php
// Inicializar variables para almacenar errores
$errores = [];

// Función para validar el DNI
function validarDNI($dni) {
    // Definir un patrón regex para un DNI válido (8 dígitos seguidos de una letra)
    $patron = '/^\d{8}[A-Za-z]$/';
    if (!preg_match($patron, $dni)) {
        return false;
    }
    // Extraer los 8 primeros dígitos del DNI
    $numero = substr($dni, 0, 8);
    // Extraer la letra del DNI y convertirla a mayúscula
    $letra = strtoupper(substr($dni, 8, 1));
    $letrasValidas = "TRWAGMYFPDXBNJZSQVHLCKE";
    $indice = $numero % 23;
    $letraCalculada = $letrasValidas[$indice];
    // Comparar la letra del DNI con la letra calculada
    return ($letra === $letraCalculada);
}



// Verificar si la solicitud HTTP es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario desde la solicitud POST
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $contrasena = $_POST["contrasena"];
    $repetirContrasena = $_POST["repetir_contrasena"];
    $dni = $_POST["dni"];
    $correo = $_POST["correo"];
    $dni = $_POST["dni"];


    // Validación del nombre
    if (empty($nombre) || strlen($nombre) < 3) {
        $errores[] = "El nombre no puede estar vacío y debe tener al menos 3 caracteres.";
    }


    // Validación de apellidos
    $apellidosArray = explode(" ", $apellidos);
    if (count($apellidosArray) != 2 || strlen($apellidosArray[0]) < 3 || strlen($apellidosArray[1]) < 3) {
        $errores[] = "Por favor, ingresa ambos apellidos con al menos 3 caracteres cada uno.";
    }


    // Validación de contraseña
    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/', $contrasena)) {
        $errores[] = "La contraseña debe contener al menos 8 caracteres con al menos 1 mayúscula, 1 minúscula y 1 número.";
    }


    // Validación de repetir contraseña
    if ($contrasena !== $repetirContrasena) {
        $errores[] = "Las contraseñas no coinciden.";
    }


    // Validación de fecha de nacimiento (debe validarse para asegurarse de que sea una fecha válida y mayor de edad)
    if (!preg_match('/^\d{2}-\d{2}-\d{4}$/', $fecha)) {
        $errores[] = "La fecha no es valida.";
        $fecha = "";

    }

    // Validación del DNI
    if (!validarDNI($dni)) {
        $errores[] = "El DNI no es válido.";
    }


    // Validación del correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }


    // Validación de la imagen (tipo y que no esté vacía)



    // Si no hay errores, los datos son válidos
    if (empty($errores)) {
        // Mostrar los datos incluida la foto
        echo "Datos válidos:<br>";
        echo "<br>Nombre: " . $nombre;
        echo "<br>Apellidos: " . $apellidos;
        echo "<br>DNI: " . $dni;
        echo "<br>Correo Electrónico: " . $correo;
        //falta la imagen
    } else {
        // Mostrar los errores
        foreach ($errores as $error) {
            echo $error . "<br>";
        }
    }
}
?>