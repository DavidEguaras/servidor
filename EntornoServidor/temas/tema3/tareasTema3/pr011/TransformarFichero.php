<?php
// Nombre del archivo CSV y XML
$archivoCSV = 'notas.csv';
$archivoXML = 'notas.xml';

// $dom->formatOutput = true;

// Lee el archivo CSV
if (($gestor = fopen($archivoCSV, 'r')) !== false) {
    // Crea un objeto SimpleXMLElement
    $xml = new SimpleXMLElement('<datos></datos>');

    // Lee la primera línea del archivo CSV como encabezados
    $encabezados = fgetcsv($gestor);

    while (($datos = fgetcsv($gestor)) !== false) {
        // Crea un nuevo elemento 'registro' para cada fila en el CSV
        $registro = $xml->addChild('registro');

        // Agrega los elementos al XML
        foreach ($encabezados as $indice => $encabezado) {
            $registro->addChild($encabezado, $datos[$indice]);
        }
    }

    // Guarda el XML en un archivo
    file_put_contents($archivoXML, $xml->asXML());

    // Cierra el archivo CSV
    fclose($gestor);

    echo "El archivo CSV se ha convertido correctamente a XML.";
} else {
    echo "No se pudo abrir el archivo CSV.";
}
?>
