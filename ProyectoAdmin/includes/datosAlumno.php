<?php

include_once 'basededatos.php';
include_once 'funciones.php';

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 01 Jan 1996 00:00:00 GMT');
header('Content-type: application/json');

if(sesionIniciada($conexion) && isset($_GET['idAlumno'])){
    $result = datosAlumno($conexion, $_GET['idAlumno']);
    $json = json_encode($result);
    echo $json;
}
?>