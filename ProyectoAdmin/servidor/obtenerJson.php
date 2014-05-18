<?php
include_once '../includes/basededatos.php';
include_once '../includes/funciones.php';
include_once '../includes/funcionesAlumno.php';
session_start();
if(sesionIniciada($conexion)){// si es instructor
   echo(rutinasDeAlumno($conexion, $_GET['idAlumno'], $_SESSION['usuario']));
}else if(isset ($_POST['idAlumno'],$_POST['contrasena'])){
    echo(rutinasDeAlumno($conexion, $_POST['idAlumno'], NULL));
}else{
    die('No se han proporcionado datos de inicio de sesion suficiente');
}