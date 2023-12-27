<?php
// Comprobamos si se han enviado datos por el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $errores = [];

    // Validación del nombre
    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    }

    // Validación del correo electrónico
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }

    // Validación de la contraseña
    if (empty($password) || strlen($password) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    // Si hay errores, mostramos los mensajes
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo $error . "<br>";
        }
    } else {
        // Si no hay errores, mostramos mensaje de éxito (aquí puedes guardar los datos en una base de datos, por ejemplo)
        echo "¡Registro exitoso!";
    }
} else {
    // Si se intenta acceder al archivo directamente sin enviar datos por el formulario
    echo "Acceso inválido.";
}
?>
