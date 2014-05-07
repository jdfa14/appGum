<?php
    include_once 'basededatos.php';
    include_once 'funciones.php';
    
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];
    if(iniciarSesion($conexion, $usuario, $contrasena)){
        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['contrasena'] = $contrasena;
        header("Location: ../agregarUsuario.php");
    }else{
        print("Error: Datos incorrectos");
        header("Location: ../index.php");
    }
    