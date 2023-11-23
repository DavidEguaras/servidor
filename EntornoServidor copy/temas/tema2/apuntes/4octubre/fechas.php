

<?php
// Fecha original en formato texto
$fechaOriginal = "2023-10-04";

// Mostrar la fecha original
echo "Fecha original: " . $fechaOriginal . "<br>";

// Convertir la fecha original a un timestamp (número de segundos desde el 1 de enero de 1970)
$timestamp = strtotime($fechaOriginal);

// Mostrar el timestamp obtenido
echo "Timestamp: " . $timestamp . "<br>";

// Convertir el timestamp de nuevo a formato de fecha legible
$fechaFormateada = date("Y-m-d", $timestamp);

// Mostrar la fecha formateada a partir del timestamp
echo "Fecha formateada desde el timestamp: " . $fechaFormateada . "<br>";

// Operaciones con strtotime(): sumar 7 días a la fecha original
$nuevaFechaSuma = date("Y-m-d", strtotime($fechaOriginal . " +7 days"));

// Mostrar la nueva fecha después de sumar 7 días
echo "Nueva fecha (sumando 7 días): " . $nuevaFechaSuma . "<br>";

// Operaciones con strtotime(): restar 3 días a la fecha original
$nuevaFechaResta = date("Y-m-d", strtotime($fechaOriginal . " -3 days"));

// Mostrar la nueva fecha después de restar 3 días
echo "Nueva fecha (restando 3 días): " . $nuevaFechaResta . "<br>";


//===========================================USAMOS ESTOS COMANDOS===========================================
// Obtener la fecha actual en el formato "Año-Mes-Día"
$fechaActual = date("Y-m-d");
echo "Fecha actual: " . $fechaActual . "<br>";

// Obtener la hora actual en el formato "Hora:Minuto:Segundo"
$horaActual = date("H:i:s");
echo "Hora actual: " . $horaActual . "<br>";

// Formatear una fecha específica ("Año-Mes-Día") a ("Día/Mes/Año")
$fechaOriginal = "2023-10-04";
$fechaFormateada = date("d/m/Y", strtotime($fechaOriginal));
echo "Fecha formateada: " . $fechaFormateada . "<br>";

// Sumar días a una fecha específica
$fechaOriginal = "2023-10-04";
$diasASumar = 7;
$nuevaFechaSuma = date("Y-m-d", strtotime($fechaOriginal . " +$diasASumar days"));
echo "Nueva fecha (sumando $diasASumar días): " . $nuevaFechaSuma . "<br>";

// Restar días a una fecha específica
$diasARestar = 3;
$nuevaFechaResta = date("Y-m-d", strtotime($fechaOriginal . " -$diasARestar days"));
echo "Nueva fecha (restando $diasARestar días): " . $nuevaFechaResta . "<br>";

// Calcular la diferencia en segundos entre dos fechas
$fecha1 = "2023-10-01";
$fecha2 = "2023-10-10";
$diferencia = strtotime($fecha2) - strtotime($fecha1);

// Calcular la diferencia en días a partir de la diferencia en segundos
$diasDiferencia = floor($diferencia / (60 * 60 * 24));
echo "Diferencia en días entre $fecha1 y $fecha2: " . $diasDiferencia . " días";


$ruta = $_SERVER['SCRIPT_FILENAME'];
echo "<br>";
echo "<a href='http://".$_SERVER['SERVER_ADDR']."/verCodigo.php?fichero=".$_SERVER['SCRIPT_FILENAME']."'>para ver codigo </a>";
?>