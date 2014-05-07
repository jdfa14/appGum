<?php
    include_once 'basededatos.php';
    include_once 'funciones.php';
    
    if(!agregarInstructor($conexion,$_POST['usuario'],$_POST['correo'],$_POST['contrasena'])){
        die("Error con la insercon");
    }
    header("Location: ../register_success.php");

