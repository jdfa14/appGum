<?php
include_once 'basededatos.php';
include_once 'funciones.php';
session_start();

if(isset($_GET['idAlumno']) && sesionIniciada($conexion)){
    eliminarAlumno($conexion, $_GET['idAlumno'], $_SESSION['usuario']);
}
