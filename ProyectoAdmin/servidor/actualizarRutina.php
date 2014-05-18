<?php

include_once '../includes/basededatos.php';
include_once '../includes/funciones.php';

if(sesionIniciada($conexion)){//es un instructor   
    $json = json_decode($_GET["json"],true);
    $json['dias'] = array_reverse($json['dias']);
    $json = json_encode($json);
    actualizaJson($conexion, $json, $_GET["idAlumno"], $_GET["idInstructor"]);
}

