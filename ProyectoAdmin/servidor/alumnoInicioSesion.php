<?php
    include_once '../includes/basededatos.php';
    include_once '../includes/funcionesAlumno.php';

    if(isset($_POST['idAlumno'],$_POST['contrasena']) && iniciarSesionAlumno($conexion, $_POST['idAlumno'], $_POST['contrasena'])){
        echo '{"success":1}';
    }else{
        echo '{"success":0,"error_message":"Datos incorrectos."}';
    }