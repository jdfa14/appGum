<?php
function agregarUsuario($conexion,$matricula,$instructor,$nombre,$apellido,$correo,$peso,$nacimiento,$sexo,$contrasena){
    mysqli_autocommit($conexion, FALSE);
    $query1 = "SELECT * FROM alumno WHERE idAlumno = '".$matricula."';";
    $result1 =  mysqli_query($conexion,$query1);
    if(mysqli_num_rows($result1) <= 0){//no existe dicho alumno
        $query2 = "INSERT INTO alumno (idAlumno, nombre, apellido, correo, peso, nacimiento, sexo, contrasena) "
            . "VALUES ("
            . "'".$matricula."', "
            . "'".$nombre."', "
            . "'".$apellido."', "
            . "'".$correo."', "
            . "'".$peso."', "
            . "'".$nacimiento."', "
            . "'".$sexo."', "
            . "'".$contrasena."');";
        $result2 =  mysqli_query($conexion,$query2);
        if(!$result2){
            print('No se pudo insertar los datos, query :' . $query2);
            print('Error :' . mysql_error());
            die('inserta Alumno');
            mysqli_autocommit($conexion, TRUE);
            return 0;
        }
        $date = date("Y-m-d");
        $query3 = "INSERT INTO alumnoinstructor (idAlumno, idInstructor, fechaRegistro) "
                . "VALUES ("
                . "'".$matricula."', "
                . "'".$instructor."', "
                . "'".$date."');";
        $result3 =  mysqli_query($conexion,$query3);
        if(!$result3){
            print('No se pudo insertar los datos, query :' . $query3);
            print('Error :' . mysql_error());
            die('relacion');
            mysqli_autocommit($conexion, TRUE);
            return 0;
        }
        mysqli_commit($conexion);
        
    }else{
        mysqli_autocommit($conexion, TRUE);
        return 0;
    }
    mysqli_autocommit($conexion, TRUE);
    return 1;
}

function agregarInstructor($conexion,$usuario,$correo,$contrasena){
    $query = "INSERT INTO member (username, email, password) "
            . "VALUES ("
            . "'".$usuario."', "
            . "'".$correo."', "
            . "'".$contrasena."');";
    $result =  mysqli_query($conexion,$query);
    if(!$result){
        print('No se pudo insertar instructor, query :' . $query);
        print('Error :' . mysql_error());
        return 0;
    }
    return 1;
}

function iniciarSesion($conexion,$usuario,$contrasena){
    $query = "SELECT * FROM member WHERE username= '".$usuario."';";
    $result =  mysqli_query($conexion,$query);
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

function alumnosDeInstructor($conexion,$instructor){
    $query = "SELECT a.*, i.fechaFinal FROM alumno as a, alumnoinstructor as i WHERE a.idAlumno = i.idAlumno AND i.idAlumno IN ( SELECT idAlumno FROM member JOIN alumnoinstructor ON (username = idInstructor) WHERE username = '".$instructor."');";
    $result =  mysqli_query($conexion,$query);
    if(!$result){
        print('No se pudo obtener alumnos. Query :' . $query );
        print('Error :' . mysql_error());
        return 0;
    }else{
        return $result;
    }
    return NULL;
}

function datosAlumno($conexion, $idAlumno){
    $query = "SELECT * FROM alumno WHERE idAlumno = '".$idAlumno."';";
    $result =  mysqli_query($conexion,$query);
    if(!$result){
        return 0;
    }else{
        return mysqli_fetch_assoc($result);
    }
}

function rutinasDeAlumno($conexion, $idAlumno , $idInstructor){
    if($idInstructor === NULL){
        $query1 = "SELECT username
            FROM member JOIN alumnoInstructor ON (username = idInstructor) JOIN alumno ON ( alumnoInstructor.idAlumno = alumno.idAlumno)
            WHERE fechaFinal IS NULL AND alumno.idAlumno = '".$idAlumno."';";
        $result1 =  mysqli_query($conexion,$query1);
        $renglon = mysqli_fetch_assoc($result1);
        $idInstructor = $renglon['username'];
    }
    
    $query = "SELECT definicion FROM alumnoInstructor WHERE idAlumno='".$idAlumno."' and idInstructor='".$idInstructor."' and fechaFinal IS NULL;";
    $result =  mysqli_query($conexion,$query);
    if(!$result){
        return "null";
    }
    $renglon = mysqli_fetch_assoc($result);
    $json = $renglon['definicion'];
    return $json;
}

function sesionIniciada($con){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION['usuario'],$_SESSION['contrasena'],$_SESSION['tipo'])){
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

function actualizaJson($conexion,$json,$idAlumno,$idInstructor){
    if($idInstructor === NULL){
        $query1 = "SELECT username
            FROM member JOIN alumnoInstructor ON (username = idInstructor) JOIN alumno ON ( alumnoInstructor.idAlumno = alumno.idAlumno)
            WHERE fechaFinal IS NULL AND alumno.idAlumno = '".$idAlumno."';";
        $result1 =  mysqli_query($conexion,$query1);
        $renglon = mysqli_fetch_assoc($result1);
        $idInstructor = $renglon['username'];
    }
    
    $query = "UPDATE alumnoinstructor SET definicion ='".$json."' WHERE idAlumno='".$idAlumno."' and idInstructor='".$idInstructor."' and fechaFinal IS NULL;";
    $result =  mysqli_query($conexion,$query);
    if(!$result){
        return '{ "success" : 0 }';
    }
    return '{ "success" : 1 }';
}

function eliminarAlumno($conexion,$idAlumno,$idInstructor){
    $fecha = date("Y-m-d");
    $query="UPDATE alumnoinstructor SET fechaFinal='".$fecha."' WHERE idAlumno='".$idAlumno."' and`idInstructor`='".$idInstructor."' AND fechaFinal IS NULL;";
    $result =  mysqli_query($conexion,$query);
    if(!$result){
        print('No se pudo terminar el ciclo del alumno. Query :' . $query);
        print('Error :' . mysql_error());
        return 0;
    }
    return 1;
}