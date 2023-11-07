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


// Función para validar un DNI español
function validarDNI($dni) {
    $patron = '/^\d{8}[A-Za-z]$/';
    if (!preg_match($patron, $dni)) {
        return false;
    }

    // Lógica de validación del DNI (cálculo de la letra)

    return true; // O false si no es válido
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