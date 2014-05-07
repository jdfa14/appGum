<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Protected Page</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        <div class="banner-top">
            <!-- aqui va cosas legales del tec y asi -->
        </div>
        <div class="instructor">
            <h5>Hola Jesus David De La Fuente Amaya</h5>
        </div>
        <div class="alumnos">
            <table>
                <tr>
                    <th>Matricula</th>
                    <th>Nombre</th>
                    <th>Dias cumplidos</th>
                </tr>
                <?php 
                    $studentsRows = get_students($_SESSION['user_id']) ;
                    if($studentsRows){// en caso de que si tenga objetos
                        while($row = mysqli_fetch_assoc($resultSet)){
                ?>
                <tr>
                    <form name="ModificarRutina" action="index.php" method="POST">
                        <td></td>
                    </form>
                </tr>
                <?php
                        }
                    }else{
                        
                    }
                ?><!-- optiene la cantidad de alumnos asesorados por el profesor -->
            
            
            </table>
        </div>
            
            
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>