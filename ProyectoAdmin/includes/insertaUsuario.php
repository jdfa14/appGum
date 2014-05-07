<?php
    include_once 'basededatos.php';
    include_once 'funciones.php';
    session_start();
    $nacimiento = $_POST['anio'] . "-" . $_POST['mes'] . "-" . $_POST['dia'];
    if(!agregarUsuario($conexion, $_POST['matricula'], $_SESSION['usuario'] ,$_POST['nombres'], $_POST['apellidos'], $_POST['correo'], $_POST['peso'], $nacimiento, $_POST['sexo'], $_POST['matricula'])){
        die("Error con la insercon");
    }
    header("Location: ../agregarUsuario.php");