<?php

function cargarDatos($archivo) {
    if (!file_exists($archivo)) {
        return [];
    }
    $json = file_get_contents($archivo);
    return json_decode($json, true);
}

function guardarDatos($archivo, $datos) {
    $json = json_encode($datos, JSON_PRETTY_PRINT);
    file_put_contents($archivo, $json);
}

?>
