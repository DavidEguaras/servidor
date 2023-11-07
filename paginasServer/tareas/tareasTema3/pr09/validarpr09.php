
<?php
// Inicializar variables para almacenar errores
$errores = [];

// Incluir o requerir el archivo que contiene la función validarDNI
require_once('/var/www/servidor/librerias/funciones.php'); // Ajusta la ruta según la ubicación real de funciones.php



// Verificar si la solicitud HTTP es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario desde la solicitud POST
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $contrasena = $_POST["contrasena"];
    $repetirContrasena = $_POST["repetir_contrasena"];
    $fechaNacimiento = $_POST["fecha_nacimiento"];
    $dni = $_POST["dni"];
    $correo = $_POST["correo"];

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
        // Procesar los datos, guardar en la base de datos, etc.

        // Mostrar los datos incluida la foto
        echo "Datos válidos:";
        echo "Nombre: " . $nombre;
        echo "Apellidos: " . $apellidos;
        echo "Fecha de Nacimiento: " . $fechaNacimiento;
        echo "DNI: " . $dni;
        echo "Correo Electrónico: " . $correo;

        // Procesar y guardar la imagen
    } else {
        // Mostrar los errores
        foreach ($errores as $error) {
            echo $error . "<br>";
        }
    }
}
?>