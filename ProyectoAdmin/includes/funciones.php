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