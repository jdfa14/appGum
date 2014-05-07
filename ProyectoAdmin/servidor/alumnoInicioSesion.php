<?php
    include_once '../includes/basededatos.php';
    include_once '../includes/funciones.php';
    
    $matricula = $_GET['nombre'];
    $contrasena = $_GET['contrasena'];
    
    if(iniciarSesionAlumno($conexion, $matricula, $contrasena)){
        echo json_encode(array('result' => 1));
    }else{
        echo json_encode(array('result' => 0));
    }

