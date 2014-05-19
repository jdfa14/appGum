<?php
function iniciarSesionAlumno($conexion,$usuario,$contrasena){
    $query = "SELECT * FROM alumno WHERE idAlumno= '".$usuario."';";
    $result =  mysqli_query($conexion,$query);
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
