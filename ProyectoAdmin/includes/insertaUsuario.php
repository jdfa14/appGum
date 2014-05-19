<?php
    include_once 'basededatos.php';
    include_once 'funciones.php';
    session_start();
    $nacimiento = $_POST['anio'] . "-" . $_POST['mes'] . "-" . $_POST['dia'];
    if(!agregarUsuario($conexion, $_POST['matricula'], $_SESSION['usuario'] ,$_POST['nombres'], $_POST['apellidos'], $_POST['correo'], $_POST['peso'], $nacimiento, $_POST['sexo'], $_POST['matricula'])){
        header("Location: ../errorPage.php?error=No se pudo insertar usuario");
    }
    header("Location: ../listaAlumnos.php");