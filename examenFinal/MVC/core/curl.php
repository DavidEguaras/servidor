<?php

function get($recurso, $token = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URI_API . $recurso);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if ($token) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    }
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
/*
function post($recurso, $array) {
    $array = json_encode($array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URI_API . $recurso);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length:' . strlen($array)));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
*/

function post($recurso, $array){
    $array = json_encode($array);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, URI_API.$recurso);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //para imprimir los datos en el body
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json, Content-Length:'. strlen($array)));

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if($http_code != 201){
        echo "Ha habido algún error con la API";
    }

    $response = true;
    curl_close($ch);
    return $response;
}


?>
