<?php

include_once '../includes/basededatos.php';
include_once '../includes/funciones.php';

if(sesionIniciada($conexion)){//es un instructor   
    $json = json_decode($_GET["json"],true);
    $json['dias'] = array_reverse($json['dias']);
    $json = json_encode($json);
    actualizaJson($conexion, $json, $_GET["idAlumno"], $_GET["idInstructor"]);
}else if(isset($_POST['idAlumno'],$_POST['contrasena'],$_POST['json'])){
    echo actualizaJson($conexion, $_POST['json'], $_POST["idAlumno"], NULL);
}else {
   echo '{ "success" : 0}';
}