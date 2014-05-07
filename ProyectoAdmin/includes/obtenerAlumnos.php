<?php
    session_start();
    include_once 'basededatos.php';
    include_once 'funciones.php';
    
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
    header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
    header("Cache-Control: no-cache, must-revalidate" ); 
    header("Pragma: no-cache" );
    header("Content-Type: text/xml; charset=utf-8");
    
    $resultado = alumnosDeInstructor($conexion, $_SESSION['usuario']);
    $xml = '<?xml version="1.0" ?><root>';
    while($renglon = mysqli_fetch_assoc($resultado)){
        $xml .= '<alumno>';
        $xml .= '<matricula>';
        $xml .= $renglon['matricula'];
        $xml .= '</matricula>';
        $xml .= '<nombre>';
        $xml .= $renglon['nombre'];
        $xml .= '</nombre>';
        $xml .= '<apellido>';
        $xml .= $renglon['apellido'];
        $xml .= '</apellido>';
        $xml .= '<correo>';
        $xml .= $renglon['correo'];
        $xml .= '</correo>';
        $xml .= '<peso>';
        $xml .= $renglon['peso'];
        $xml .= '</peso>';
        $xml .= '<nacimiento>';
        $xml .= $renglon['nacimiento'];
        $xml .= '</nacimiento>';
        $xml .= '<sexo>';
        $xml .= $renglon['sexo'];
        $xml .= '</sexo>';
        $xml .= '</alumno>';
    }
    $xml .= '</root>';
    echo $xml;
?>