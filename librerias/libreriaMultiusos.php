<?php
// Función para validar un número decimal positivo
function validarDecimalPositivo($numero) {
    return filter_var($numero, FILTER_VALIDATE_FLOAT, array("options" => array("min_range" => 0))) !== false;
}


// Función para validar una fecha en formato "YYYY-MM-DD"
function validarFecha($fecha) {
    $partes = explode('-', $fecha);
    if (count($partes) == 3 && checkdate($partes[1], $partes[2], $partes[0])) {
        return true;
    }
    return false;
}


// Función para validar un número de teléfono en formato internacional
function validarTelefono($telefono) {
    // Ajusta el patrón según tus necesidades (este es un patrón simple)
    $patron = '/^\+[0-9]+$/';
    return preg_match($patron, $telefono) === 1;
}


// Función para validar una dirección IP
function validarDireccionIP($ip) {
    return filter_var($ip, FILTER_VALIDATE_IP) !== false;
}


// Función para validar una contraseña segura (debe contener mayúsculas, minúsculas, números y caracteres especiales)
function validarContrasenaSegura($contrasena) {
    return preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/', $contrasena) === 1;
}


// Función para validar el DNI
function validarDNI($dni) {
    // Definir un patrón regex para un DNI válido (8 dígitos seguidos de una letra)
    $patron = '/^\d{8}[A-Za-z]$/';
    // Verificar si el DNI cumple con el patrón
    if (!preg_match($patron, $dni)) {
        return false;
    }

    // Extraer los 8 primeros dígitos del DNI
    $numero = substr($dni, 0, 8);
    // Extraer la letra del DNI y convertirla a mayúscula
    $letra = strtoupper(substr($dni, 8, 1));
    // Definir las letras válidas para el cálculo de la letra del DNI
    $letrasValidas = "TRWAGMYFPDXBNJZSQVHLCKE";

    // Calcular el índice de la letra esperada basado en los dígitos del número
    $indice = $numero % 23;
    // Obtener la letra esperada del array de letras válidas
    $letraCalculada = $letrasValidas[$indice];

    // Comparar la letra del DNI con la letra calculada
    return ($letra === $letraCalculada);
}



// Función para validar un correo electrónico
function validarCorreoElectronico($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL) !== false;
}


// Función para validar un número entero positivo
function validarEnteroPositivo($numero) {
    return filter_var($numero, FILTER_VALIDATE_INT, array("options" => array("min_range" => 0))) !== false;
}


// Función para validar una cadena alfanumérica
function validarCadenaAlfanumerica($cadena) {
    return ctype_alnum($cadena);
}


// Función para validar una URL
function validarURL($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}






?>