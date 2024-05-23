<?php


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

function get($recurso){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URI_API.$recurso);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function post($recurso, $array){
    $array = json_encode($array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URI_API.$recurso);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length:'. strlen($array)));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $response = true;
    return $response;
}

function put($recurso, $id, $array){
    $array = json_encode($array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URI_API.$recurso.'/'.$id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length:'. strlen($array)));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $response;
}

function deleteFromAPI($recurso, $id) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URI_API . $recurso . '/' . $id);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
?>

