<?php

function agregarUsuario($con,$matricula,$instructor,$nombre,$apellido,$correo,$peso,$nacimiento,$sexo,$contrasena){
    
    $query = "INSERT INTO alumno (matricula, instructor, nombre, apellido, correo, peso, nacimiento, sexo, contrasena) "
            . "VALUES ("
            . "'".$matricula."', "
            . "'".$instructor."', "
            . "'".$nombre."', "
            . "'".$apellido."', "
            . "'".$correo."', "
            . "'".$peso."', "
            . "'".$nacimiento."', "
            . "'".$sexo."', "
            . "'".$contrasena."');";
    $result =  mysqli_query($con,$query);
    if(!$result){
        print('No se pudo insertar los datos, query :' . $query);
        print('Error :' . mysql_error());
        return 0;
    }
    return 1;
}

function agregarInstructor($con,$usuario,$correo,$contrasena){
    $query = "INSERT INTO member (username, email, password) "
            . "VALUES ("
            . "'".$usuario."', "
            . "'".$correo."', "
            . "'".$contrasena."');";
    $result =  mysqli_query($con,$query);
    if(!$result){
        print('No se pudo insertar instructor, query :' . $query);
        print('Error :' . mysql_error());
        return 0;
    }
    return 1;
}

function iniciarSesion($con,$usuario,$contrasena){
    $query = "SELECT * FROM member WHERE username= '".$usuario."';";
    $result =  mysqli_query($con,$query);
    if(!$result){
        print('No se pudo iniciar sesion. Query :' . $query);
        print('Error :' . mysql_error());
        return 0;
    }else{
        if($row = mysqli_fetch_assoc($result)){
            if($contrasena == $row['password']){
                return 1;
            }else{
                print("Error: contraseña incorrecta");
                return 0;
            }
        }else{
            print("Error: No hay renglones");
            return 0;
        }
    }
}

function alumnosDeInstructor($con,$instructor){
    $query = "SELECT * FROM alumno WHERE instructor= '".$instructor."';";
    $result =  mysqli_query($con,$query);
    $array = array();
    if(!$result){
        $row = mysql_fetch_assoc($result);
        print('No se pudo obtener alumnos. Query :' . $query . $row['nombre']);
        print('Error :' . mysql_error());
        return 0;
    }else{
        return $result;
    }
    return NULL;
}

function iniciarSesionAlumno($con,$usuario,$contrasena){
    $query = "SELECT * FROM alumno WHERE matricula= '".$usuario."';";
    $result =  mysqli_query($con,$query);
    if(!$result){
        return 0;
    }else{
        if($row = mysqli_fetch_assoc($result)){
            if($contrasena == $row['contrasena']){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}

function sesionIniciada($con){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION['usuario'],$_SESSION['contrasena'])){
        return iniciarSesion($con, $_SESSION['usuario'], $_SESSION['contrasena']);
    }else{
        return false;
    }
}

function cerrarSesion(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
    session_destroy();
}