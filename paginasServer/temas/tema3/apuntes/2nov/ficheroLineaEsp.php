<?php
$tmp = tempnam(".", "temporal.txt");

if (file_exists('ficheroLineas.txt')) {
    echo "Existe el archivo";
    
    if (!($fp = fopen('ficheroLineas.txt', 'r')) || !($ft = fopen($tmp, 'w'))) {
        echo "Ha habido un problema al abrir el fichero";
    } else {
        $texto = "Mi nueva línea\n"; // Include the newline character in the new line

        while (!feof($fp)) {
            $leido = fgets($fp);
            if ($leido !== false) {
                fputs($ft, $leido);
            }
        }

        fputs($ft, $texto);

        fclose($fp);
        fclose($ft);

        unlink("ficheroLineas.txt");
        if (rename($tmp, "ficheroLineas.txt")) {
            echo "Archivo modificado con éxito.";
        } else {
            echo "Error al renombrar el archivo temporal.";
        }
    }
} else {
    echo "No existe el archivo";
}
?>