<?php

include_once '../includes/basededatos.php';
include_once '../includes/funciones.php';

if(sesionIniciada($conexion)){//es un instructor    
    actualizaJson($conexion, $_GET["json"], $_GET["idAlumno"], $_GET["idInstructor"]);
}

