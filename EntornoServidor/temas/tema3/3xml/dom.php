<?php
$dom = new DOMDocument('1.0', 'utf-8');
$raiz = $dom->appendChild($dom->createElement('instrumentos'));

$instrumento = $dom->createElement('instrumento');
$nombre = $dom->createElement('nombre', 'guitarra');
$familia = $dom->createElement('familia', 'cuerda');

$raiz->appendChild($instrumento);
$instrumento->appendChild($nombre);
$instrumento->appendChild($familia);
$instrumento->setAttribute('id', '1');

$instrumento = $raiz->appendChild($dom->createElement('instrumento'));
$instrumento->appendChild($dom->createElement('nombre', 'violin'));
$instrumento->appendChild($familia);
$instrumento->setAttribute('id', '2');

$dom->formatOutput = true;
$dom->save('instrumentos.xml');

$dom->load('instrumentos.xml');

//Cuando NO se lo quiero buscar en el documento
foreach ($dom->childNodes as $instrumento) {
    if ($instrumento->nodeType == 1) {
        $nodo = $instrumento->firstChild;
        do {
            if ($nodo->nodeType == 1) {
                echo "\n" . $nodo->tagName . ":" . $nodo->nodeValue;
            }
        } while ($nodo = $nodo->nextSibling);
    }
}

//Cuando sí se lo quiero buscar en el documento
$instrumentoLista = $dom->getElementsByTagName('instrumento');
foreach ($instrumentoLista as $value) {
    $a = $value -> getElementsByTagName('nombre');
    echo "<br>";
    echo $a->item(0)->tagName .":".$a->item(0) -> nodeValue;

    $a = $value -> getElementsByTagName('familia');
    echo "<br>";
    echo $a->item(0)->tagName .":".$a->item(0) -> nodeValue;
}
 
header('Content-Type: text/xml');
header("Content-Disposition: attachment; filename=instrumentos.xml");


?>
