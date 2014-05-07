<?php
    include_once '../includes/basededatos.php';
    include_once '../includes/funciones.php';
    
    session_start();
    
    $matricula = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];
    
    
    if(iniciarSesionAlumno($conexion, $matricula, $contrasena)){
        $_SESSION['matricula'] = $matricula;
        
        echo '{"success":1}';
    }else{
        echo '{"success":0,"error_message":"Username and/or password is invalid. "}';
    }

